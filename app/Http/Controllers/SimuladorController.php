<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimuladorController extends Controller
{
    private $dadosSimulador;
    private $simulacao = [];

    public function simular(Request $request)
    {
        $this->carregarArquivoDadosSimulador()
            ->simularEmprestimo($request->valor_emprestimo)
            ->filtrarInstituicao($request->instituicoes)
            ->filtrarConvenio($request->convenios ? $request->convenios : [])
            ->filtrarParcelas($request->qtdParcelas ? $request->qtdParcelas : 0)
        ;
        return \response()->json($this->simulacao);
    }

    private function carregarArquivoDadosSimulador(): self
    {
        $this->dadosSimulador = json_decode(\File::get(storage_path("app/public/simulador/taxas_instituicoes.json")));
        return $this;
    }

    private function simularEmprestimo(float $valorEmprestimo): self
    {
        foreach ($this->dadosSimulador as $dados) {
            $this->simulacao[$dados->instituicao][] = [
                "taxa"            => $dados->taxaJuros,
                "parcelas"        => $dados->parcelas,
                "valor_parcela"    => $this->calcularValorDaParcela($valorEmprestimo, $dados->coeficiente),
                "convenio"        => $dados->convenio,
            ];
        }
        return $this;
    }

    private function calcularValorDaParcela(float $valorEmprestimo, float $coeficiente): float
    {
        return round($valorEmprestimo * $coeficiente, 2);
    }

    private function filtrarInstituicao(array $instituicoes): self
    {
        if (\count($instituicoes)) {
            $arrayAux = [];
            foreach ($instituicoes as $key => $instituicao) {
                if (\array_key_exists($instituicao, $this->simulacao)) {
                    $arrayAux[$instituicao] = $this->simulacao[$instituicao];
                }
            }
            $this->simulacao = $arrayAux;
        }
        return $this;
    }

    private function filtrarConvenio(array $convenios = []): self
    {
        if (!empty($convenios)) {
            foreach ($this->simulacao as $instituicao => $simulacoes) {
                $simulacoesFiltradas = [];
                foreach ($simulacoes as $simulacao) {
                    if (in_array($simulacao['convenio'], $convenios)) {
                        $simulacoesFiltradas[] = $simulacao;
                    }
                }
                $this->simulacao[$instituicao] = $simulacoesFiltradas;
            }

            $this->simulacao = array_filter($this->simulacao, function ($simulacoes) {
                return !empty($simulacoes);
            });
        }
        return $this;
    }

    private function filtrarParcelas(int $quantidadeParcelas): self
    {
        if($quantidadeParcelas > 0) {
            foreach ($this->simulacao as $instituicao => $simulacoes) {
                $simulacoesFiltradas = [];
                foreach ($simulacoes as $simulacao) {
                    if ($simulacao['parcelas'] >= $quantidadeParcelas) {
                        $simulacoesFiltradas[] = $simulacao;
                    }
                }
                $this->simulacao[$instituicao] = $simulacoesFiltradas;
            }

            $this->simulacao = array_filter($this->simulacao, function ($simulacoes) {
                return !empty($simulacoes);
            });
        }

        return $this;
    }
}
