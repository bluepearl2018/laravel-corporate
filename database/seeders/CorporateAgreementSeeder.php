<?php

namespace Eutranet\Corporate\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Eutranet\Setup\Models\Agreement;

class CorporateAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demoArray = array(
            array(
                'description' => '{"en":"Corporate agreement", "pt":"Contrato corporate" "fr":"Description du contrat corporate"}',
                'name' => '{"en":"Corporate contract", "fr":"Contrat corporate", "pt":"CONTRATO corporate"}',
                'lead' => '{"en":"B2C services", "fr":"Services aux particuliers", "ptr":"Segmento particulares" }',
                'sections' => '{"user-info","financial-info", "service", "corporate-general-terms"}', // To get partial blades...
                'general_terms' => '{"en":"General terms of service", "fr":"Conditions générales de service", "pt":"CLAÚSULAS CONTRATUAIS
A Florbela Oliveira - Financial Advisors Lda existe com um Propósito, aconselhar as Famílias em matéria de endividamento, procedendo à elaboração do Diagnostico Financeiro do Orçamento Familiar, com vista à redução dos encargos e despesas mensais, elaboração de planos de pagamentos e renegociação com credores, no sentido da redução das responsabilidades e alargamento do prazo.
1)A Florbela Oliveira - Financial Advisors Lda é uma empresa de origem Portuguesa que se dedica à prestação de serviços de consultoria financeira vocacionada para aconselhar as Famílias em matéria de Endividamento.
2)A Florbela Oliveira - Financial Advisors Lda identificado na frente do presente contrato não garante a concretização do plano de pagamentos, estando este dependente da aprovação dos credores.
3) Os serviços que a Florbela Oliveira - Financial Advisors Lda prestará nos termos do presente contrato consistem no acompanhamento do Cliente identificado na frente do presente contrato nos seguintes passos:
i) Diagnóstico Financeiro do Orçamento Familiar;
ii) Avaliação do Perfil Financeiro e Enquadramento Sócio-Económico da Família;
iii) Redução de Encargos e despesas mensais do Agregado Familiar;
iv) Consolidação de Dividas com objectivo da redução das prestações mensais do agregado familiar;
v) Elaboração de planos de pagamentos e renegociação com credores através de procedimentos conciliatórios, no sentido da redução das responsabilidades e alargamento de prazos;
vi) Apresentação da proposta de renegociação junto dos Credores, tendo em conta o orçamento familiar.
4) As quantias previstas na frente do presente contrato a título de remuneração da Florbela Oliveira - Financial Advisors Lda serão devidas pelo Cliente nos seguintes casos:
(i) Elaboração do Plano de Pagamentos conforme capacidade financeira do Cliente;
(ii) Renegociação com credores com base no Plano de Pagamentos elaborado para o efeito;
(iii) Recusa por facto imputável ao Cliente decorrente de, na fase de pré-negociação, terem sido ocultados factos relevantes para a elaboração do plano de reembolso, nomeadamente respeitantes ao rendimento do Cliente, à existência de outros créditos ou à existência de incidentes que agravem ou impossibilitem aprovação (situação de incumprimento perante a banca, situações de cheques sem cobertura, situações de existência de dívidas fiscais, etc.
5) As Condições de Pagamento das quantias previstas, na frente do presente contrato, terão de ser cumpridas pelo cliente de acordo com o seguinte:
(i) A Consulta Preliminar, o valor devido deverá ser liquidado no final da mesma;
(ii) No que concerne ao Custo de Dossier, no âmbito dos serviços prestados, o valor devido deverá ser liquidado em duas fases: 50% do mesmo na adjudicação do serviço mediante a assinatura do Contrato de Prestação de Serviços e 50% aquando da conclusão do dossier e validação do mesmo pelo cliente, com prazo máximo de 30 dias respectivamente;
(iii) Quanto ao Sucess Fee, o valor devido deverá ser de 1% do valor dos créditos renegociados e de 5% do valor exonerado. Estes valores deverão ser liquidados aquando da aprovação do Plano de Reembolso pelos Credores, consolidação ou liquidação dos créditos, podendo o Consultório solicitar ao cliente uma garantia do valor total;
(iv) No âmbito do presente contrato, são invioláveis as condições implícitas ao mesmo, implicando a total e inequívoca aceitação das mesmas por parte do cliente, sem direito a reclamação.
(v) No âmbito do presente contrato, não são permitidas condições excepcionais de pagamento, ou eventuais descontos.
6) Para garantia do bom cumprimento das obrigações do cliente constantes do presente contrato, poderá a Florbela Oliveira - Financial Advisors Lda exigir a entrega, a título de caução, de um cheque do Cliente, o qual será, no entanto, devolvido ao Cliente sem ser movimentado.
7) Para a resolução de qualquer litígio emergente da relação contratual aqui estabelecida será competente o foro do Conselho onde o presente contrato é assinado, com exclusão de qualquer outro.
8) Os dados constantes deste contrato são passíveis de processamento automatizado, com vista ao estabelecimento de relações comerciais personalizadas entre o Cliente e a Florbela Oliveira - Financial Advisors Lda.
9) Pode suceder que, após uma avaliação económico-financeira do processo, a resolução de alguns problemas indicie a necessidade de exercer ou praticar actos jurídicos, tendo em vista a sua resolução.
Neste caso, a Florbela Oliveira - Financial Advisors Lda informará o cliente da necessidade de contratar um técnico capacitado e habilitado para o efeito (advogado/solicitador) e não interferirá, em qualquer circunstância, com a escolha livre e directa do mesmo pelo cliente comprometendo-se sim, a colaborar dentro das suas competências, e se necessário, com o advogado ou solicitador indicado pelo cliente tendo em vista obter a melhor resolução para os seus problemas.
A Florbela Oliveira - Financial Advisors Lda enquanto consultora financeira, poderá elaborar planos de pagamentos e outra informação de índole financeira a apresentar a credores ou a terceiras entidades não exercendo ou praticando actos jurídicos.
É assegurado ao Cliente, nos termos legais, o acesso, correcção, aditamento ou supressão das informações que lhe dizem respeito, mediante contacto dirigido por escrito à Florbela Oliveira - Financial Advisors Lda identificado na frente do presente contrato."}',
                'file_path' => null,
            ),
        );
        if (DB::table('corporate_agreements')->get()->count() < 1) {
            DB::table('corporate_agreements')->insert(
                $demoArray
            );
        }
    }
}
