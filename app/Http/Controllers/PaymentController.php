<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago;
use OpenBoleto\Banco\Bradesco;
use OpenBoleto\Agente;
use DateTime;

class PaymentController extends Controller
{

    public function creditCardPayment(Request $request)
    {
        MercadoPago\SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
        $contents = $request->all();

        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $contents['transaction_amount'];
        $payment->token = $contents['token'];
        $payment->installments = $contents['installments'];
        $payment->payment_method_id = $contents['payment_method_id'];
        $payment->issuer_id = $contents['issuer_id'];
        $payer = new MercadoPago\Payer();
        $payer->email = $contents['payer']['email'];
        $payer->identification = array(
            "type" => $contents['payer']['identification']['type'],
            "number" => $contents['payer']['identification']['number']
        );
        $payment->payer = $payer;
        $payment->save();
        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        echo json_encode($response);
    }

    public function ticket(Request $request)
    {
        $content = $request->all();
        $sacado = new Agente($content['firstName'] . $content['lastName'], $content['cpf'], $content['address'], $content['cep'], $content['city'], $content['uf']);
        $cedente = new Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');

        $boleto = new Bradesco(array(
            // Parâmetros obrigatórios
            'dataVencimento' => new DateTime('2013-01-24'),
            'valor' => $content['transactionAmount'],
            'sequencial' => 12345678,
            'sacado' => $sacado,
            'cedente' => $cedente,
            'agencia' => 1724,
            'conta' => 12345,
            'contaDv' => 2,
            'agenciaDv' => 1,
            'instrucoes' => array( // Até 8
                'Após o dia 30/11 cobrar 2% de mora e 1% de juros ao dia.',
                'Não receber após o vencimento.',
            ),
        ));


        return $boleto->getOutput();
    }
}
