<?php

namespace App\Http\Controllers;

use App\Models\Datas;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetasController extends Controller
{
    public function index()
    {
        return view("metas");
    }

    public function criarMeta()
    {
        $metas = auth()->guard('web')->user()->metas()->pluck('conteudo');
        return view('metasEscrito', ['metas' => $metas]);
    }

    public function salvarMeta(Request $request)
    {
        $metas = json_decode($request->metas_json, true);
        $userId = auth()->guard('web')->id();
        $datasId = auth()->guard('web')->user()->datas()->latest('id')->first()->id;
        $contador = 1;

        foreach ($metas as $metaTexto) {
            Meta::updateOrCreate(
                ['user_id' => $userId, 'datas_id' => $datasId, 'numero' => $contador],
                ['conteudo' => $metaTexto]
            );
            $contador++;
        }

        return redirect('/metas/dashboard');
    }


    public function deletarMeta(Meta $meta)
    {
        $user = auth()->guard('web')->user();

        if ($user->id === $meta->user_id) {
            $numeroMetaDeletada = $meta->numero;
            $meta->delete();

            Meta::where('user_id', $user->id)
                ->where('numero', '>', $numeroMetaDeletada)
                ->orderBy('numero')
                ->get()
                ->each(function ($meta) {
                    $meta->numero = $meta->numero - 1;
                    $meta->save();
                });

            return redirect()->back()->with('success', 'Meta deletada com sucesso.');
        }

        return redirect()->back()->with('error', 'Você não tem permissão para excluir esta meta.');
    }

    public function listarMetas()
    {

        $metas = [];

        if (!auth()->guard('web')->check()) {
            return redirect('/metas/entrar');
        }

        $metas = auth()->guard('web')->user()->metas()->paginate(4);
        $quantidadeMetas = $metas->count();
        return view('metasLista', ['metas' => $metas],  ['quantidadeMetas' => $quantidadeMetas] );
    }

    public function concluirMeta(Meta $meta)
    {
        $user = auth()->guard('web')->user();

        if ($user->id === $meta->user_id) {

            $novaConclusao = $meta->concluida == 0 ? 1 : 0;

            Meta::where('id', $meta->id)
                ->update(['concluida' => $novaConclusao]);

            $mensagem = $novaConclusao ? 'Meta concluída com sucesso.' :
                'Conclusão revertida com sucesso.';

            return redirect()->back()->with('success', $mensagem);
        }

        return redirect()->back()->with('error', 'Você não tem permissão para realizar essa ação.');
    }


    public function resetarMetas()
    {
        $user = auth()->guard('web')->user();

        if ($user->datas()->exists()) {

            Datas::where('user_id', $user->id)->delete();

            return redirect('/metas');
        }

        return redirect()->back()->with('error', 'Você não possui metas para resetar.');
    }
}
