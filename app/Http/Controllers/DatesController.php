<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Datas;
use App\Models\Meta;

class DatesController extends Controller
{

    public function dashboard()
    {
        $metas = auth()->guard('web')->user()->metas();
        $id = auth()->guard('web')->user()->id;

        $metasConcluidas = Meta::where('user_id', $id)->where('concluida', 1);

        $total = $metas->count();
        $concluidas = $metasConcluidas->count();
        $percentual = $total > 0 ? ($concluidas / $total) * 100 : 0;

        $ultimaData = auth()->guard('web')->user()
            ->datas()
            ->orderBy('data_inicio', 'desc')
            ->first();

        $dataInicio = $ultimaData?->data_inicio ? Carbon::parse($ultimaData->data_inicio) : null;
        $dataConclusao = $ultimaData?->data_conclusao ? Carbon::parse($ultimaData->data_conclusao) : null;

        return view("dashboard", [
            'diff' => $dataInicio->diffInDays($dataConclusao),
            'metas' => $metas,
            'metasConcluidas' => $metasConcluidas,
            'percentual' => $percentual
        ]);

        
    }

    public function salvarData(Request $request)
    {
        $request->validate([
            'data_inicio' => 'required|date',
            'data_conclusao' => 'required|date|after_or_equal:data_inicio',
        ]);

        Datas::create([
            'user_id' => auth()->guard('web')->id(),
            'data_inicio' => $request->input('data_inicio'),
            'data_conclusao' => $request->input('data_conclusao'),
        ]);

        return redirect('/metas/criar');
    }
}
