<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EntityBankAccountType as EntityBankAccountType;

class Entity_bank_account_TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EntityBankAccountType::createMany([
            [
                'label' => 'Unknown',
                'logo' => Null,
                'color' => json_encode(['Naranja' => '#ff6400', 'Negro' => '#000000']),
                'regEx' => Null
            ],[
                'label' => 'Visa',
                'logo' => '../assets/img/logos/card/visa.png',
                'color' => json_encode(['Azul oscuro' => '#1A1F71', 'Dorado' => '#FDB813']),
                'regEx' => json_encode([
                    1 => "/^4[0-9]{12}(?:[0-9]{3})?$/",
                    2 => "/^4[0-9]{15}$/",
                    3 => "/^4(?:[0-9]{12}|[0-9]{15})$/",
                    4 => "/^3[47][0-9]{13}$/"
                ])
            ],[
                'label' => 'MasterCard',
                'logo' => '../assets/img/logos/card/mastercard.png',
                'color' => json_encode(['Rojo' => '#EB001B', 'Amarillo' => '#FFDE17']),
                'regEx' => json_encode([
                    1 => "/^5[1-5][0-9]{14}$/",
                    2 => "/^5[1-5][0-9]{2}-[0-9]{4}-[0-9]{4}-[0-9]{4}$/",
                    3 => "/^5[1-5][0-9]{2}\s?[0-9]{4}\s?[0-9]{4}\s?[0-9]{4}$/",
                    4 => "/^5\d{3}[\s\-]?\d{4}[\s\-]?\d{4}[\s\-]?\d{4}$/",
                    5 => "/^5\d{3}[\s\-]?\d{4}[\s\-]?\d{4}(?:[\s\-]?\d{4})?$/"
                ])
            ],[
                'label' => 'American Express',
                'logo' => '../assets/img/logos/card/amex.png',
                'color' => json_encode(['Azul oscuro' => '#002663', 'Verde' => '#007F3E']),
                'regEx' => json_encode([
                    1 => "/^3[47][0-9]{13}$/",
                    2 => "/^3[47][0-9]{2}-[0-9]{6}-[0-9]{5}$/",
                    3 => "/^3[47][0-9]{2}\s?[0-9]{6}\s?[0-9]{5}$/"
                ])
            ],[
                'label' => 'Discover',
                'logo' => '../assets/img/logos/card/discover.png',
                'color' => json_encode(['Naranja' => '#FF6600', 'Azul claro' => '#0078D2']),
                'regEx' => json_encode([
                    1 => "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
                    2 => "/^6011[0-9]{12}$/",
                    3 => "/^6(?:011|5[0-9][0-9])[0-9]{10,13}$/"
                ])
            ],[
                'label' => "Diner's Club",
                'logo' => '../assets/img/logos/card/diners.png',
                'color' => json_encode(['Rojo' => '#DC143C', 'Blanco' => '#FFFFFF']),
                'regEx' => json_encode([
                    1 => "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/",
                    2 => "/^3(?:0[0-5]|[68][0-9])[0-9]{12}$/",
                    3 => "/^3(?:0[0-5]|[68][0-9])[0-9]{13}$/",
                    4 => "/^3(?:0[0-5]|[68][0-9])[0-9]{14}$/",
                    5 => "/^3(?:0[0-5]|[68][0-9])[0-9]{15}$/",
                    6 => "/^3(0[0-5]|[68][0-9])\d{11,16}$/"
                ])
            ],[
                'label' => 'JCB',
                'logo' => '../assets/img/logos/card/jcb.png',
                'color' => json_encode(['Rojo' => '#E30613', 'Azul claro' => '#0082CA']),
                'regEx' => json_encode([
                    1 => "/^(?:2131|1800|35\d{3})\d{11}$/",
                    2 => "/^(?:2131|1800|35\d{3})[\s\-]?\d{4}[\s\-]?\d{4}[\s\-]?\d{4}$/",
                    3 => "/^(?:2131|1800|35\d{3})[\s\-]?\d{4}[\s\-]?\d{4}[\s\-]?\d{2,3}$/"
                ])
            ],[
                'label' => 'UnionPay',
                'logo' => '../assets/img/logos/card/unionpay.png',
                'color' => json_encode(['Azul oscuro' => '#009FE3', 'Rojo' => '#E60012']),
                'regEx' => json_encode([
                    1 => "/^(62|88)\d{14,17}$/",
                    2 => "/^62\d{14,17}$/"
                ])
            ],[
                'label' => 'Maestro',
                'logo' => '../assets/img/logos/card/maestro.png',
                'color' => json_encode(['Azul oscuro' => '#0F1F2E', 'Naranja' => '#FF5F00']),
                'regEx' => json_encode([
                    1 => "/^(?:5[0678]\d\d|6304|6390|67\d\d)\d{8,15}$/",
                    2 => "/^(?:5[0678]\d\d|6304|6390|67\d\d)[\s\-]?\d{4}[\s\-]?\d{4}[\s\-]?\d{4}(?:[\s\-]?\d{2,3})?$/",
                    3 => "/^(?:5[0678]\d\d|6304|6390|67\d\d)[\s\-]?\d{4}[\s\-]?\d{4}(?:[\s\-]?\d{2,3})?$/",
                ])
            ],[
                'label' => 'AliPay',
                'logo' => '../assets/img/logos/card/alipay.png',
                'color' => json_encode(['Azul claro' => '#1C9CEA']),
                'regEx' => json_encode([
                    1 => "/^(62|88)\d{14,17}$/",
                    2 => "/^(6222\d{12}(\d{3})?)$/",
                    3 => "/^(010000\d{10})$/",
                    4 => "/^(3|4|5|6|8)\d{15}$/",
                ])
            ],[
                'label' => 'Hiper',
                'logo' => '../assets/img/logos/card/hiper.png',
                'color' => json_encode(['Verde oscuro' => '#0B9444']),
                'regEx' => json_encode([
                    1 => "/^((38|60)\d{11}(\d{2})?)?$/",
                    2 => "/^(637|639)\d{13}$/",
                    3 => "/^(50)\d{13}$/",
                    4 => "/^(56)\d{14}$/",
                    5 => "/^(34|37)\d{13}$/",
                    6 => "/^(606282\d{10}(\d{3})?)|(3841\d{15})$/",
                ])
            ],[
                'label' => 'Mir',
                'logo' => '../assets/img/logos/card/mir.png',
                'color' => json_encode(['Rojo oscuro' => '#9B1C31']),
                'regEx' => json_encode([
                    1 => "/^([0-9]{4})([0-9]{4})([0-9]{4})([0-9]{4})$/",
                ])
            ],[
                'label' => 'PayPal',
                'logo' => '../assets/img/logos/card/paypal.png',
                'color' => json_encode(['Azul oscuro' => '#003087']),
                'regEx' => json_encode([
                    1 => "/^(4\d{12}(?:\d{3})?)$/",
                ])
            ],[
                'label' => 'Hipercard',
                'logo' => '../assets/img/logos/card/hipercard.png',
                'color' => json_encode(['Amarillo' => '#FEBD00']),
                'regEx' => json_encode([
                    1 => "/^(606282\d{10}(\d{3})?)|(3841\d{15})$/",
                    2 => "/^(3841\d{15})|(606282\d{10}(\d{3})?)$/",
                    3 => "/^(637|639)\d{13}$/",
                ])
            ],[
                'label' => 'Credomatic',
                'logo' => Null,
                'color' => json_encode(['Rojo oscuro' => '#9E0C0F', 'Dorado' => '#FFC72C']),
                'regEx' => json_encode([
                    1 => "/^(4027|4536|4011|4312)\d{12}$/",
                    2 => "/^(606282\d{10}(\d{3})?)|(3841\d{15})$/",
                    3 => "/^(?:606282|3841)\d{12}(?:\d{3})?$/",
                    4 => "/^(4027|4536|4011|4312)-\d{4}-\d{4}-\d{4}$/",
                    5 => "/^(553671|426858|401011|400083|400174|400175|401106|403503|403504|403505|406662|406663|406664|406665|406666|406667|406668|406669|406670|406671|406672|406673|406674|406675|406676|406677|406678|406679|406680|406681|406682|406683|406684|406685|406686|406687|406688|406689|406690|406691|406692|406693|406694|406695|406696|406697|406698|406699|406700|406701|406702|406703|406704|406705|406706|406707|406708|406709|406710|406711|406712|406713|406714|406715|406716|406717|406718|406719|406720|406721|406722|406723|406724|406725|406726|406727|406728|406729|406730|406731|406732|406733|406734|406735|406736|406737|406738|406739|406740|406741|406742|406743|406744|406745|406746|406747|406748|406749|406750|406751|406752|406753|406754|406755|406756|406757|406758|406759|406760|406761|406762|406763|406764|406765|406766|406767|406768|406769|406770|406771|406772|406773|406774|406775|406776|406777|406778|406779|406780|406781|406782|406783|406784|406785|406786|406787|406788|406789|406790|406791|406792|406793|406794|406795|406796|406797|406798|406799|406800|406801|406802|406803|406804|406805|406806|406807|406808|406809|406810|406811|406812|406813|406814|406815|406816|406817|406818|406819|406820|406821|406822|406823|406824|406825|406826|406827|406828|406829|406830|406831|406832|406833|406834|406835|406836|406837|406838|406839|406840|406841|406842|406843|406844|406845|406846|406847|406848|406849|406850|406851|406852|406853|406854|406855|406856|406857|406858|406859|406860|406861|406862|406863|406864|406865|406866|406867|406868|406869|406870|406871|406872|406873|406874|406875|406876|406877|406878|406879|406880|406881|406882|406883|406884|406885|406886|406887|406888|406889|406890|406891|406892|406893|406894|406895|406896|406897|406898|406899|406900|406901|406902|406903|406904|406905|406906|406907|406908|406909|406910|406911|406912|406913|406914|406915|406916|406917|406918|406919|406920|406921|406922|406923|406924|406925|406926|406927|406928|406929|406930|406931|406932|406933|406934|406935|406936|406937|406938|406939|406940|406941|406942|406943|406944|406945|406946|406947|406948|406949|406950|406951|406952|406953|406954|406955|406956|406957|406958|406959|406960|406961|406962|406963|406964|406965|406966|406967|406968|406969|406970|406971|406972|406973|406974|406975|406976|406977|406978|406979|406980|406981|406982|406983|406984|406985|406986|406987|406988|406989|406990|406991|406992|406993|406994|406995|406996|406997|406998|406999|4061000|4061001|4061002|4061003|4061004|4061005|4061006|4061007|4061008|4061009|4061010|4061011|4061012|4061013|4061014|4061015|4061016|4061017|4061018|4061019|4061020|4061021|4061022|4061023|4061024|4061025|4061026|4061027|4061028|4061029|4061030|4061031|4061032|4061033|4061034|4061035|4061036|4061037|4061038|4061039|4061040|4061041|4061042|4061043|4061044|4061045|4061046|4061047|4061048|4061049|4061050|4061051|4061052|4061053|4061054|4061055|4061056|4061057|4061058|4061059|4061060|4061061|4061062|4061063|4061064|4061065|4061066|4061067|4061068|4061069|4061070|4061071|4061072|4061073|4061074|4061075|4061076|4061077|4061078|4061079|4061080|4061081|4061082|4061083|4061084|4061085|4061086|4061087|4061088|4061089|4061090|4061091|4061092|4061093|4061094|4061095|4061096|4061097|4061098|4061099|4061100|4061101|4061102|4061103|4061104|4061105|4061106|4061107|4061108|4061109|4061110|4061111|4061112|4061113|4061114|4061115|4061116|4061117|4061118|4061119|4061120|4061121|4061122|4061123|4061124|4061125|4061126|4061127|4061128|4061129|4061130|4061131|4061132|4061133|4061134|4061135|4061136|4061137|4061138|4061139|4061140|4061141|4061142|4061143|4061144|4061145|4061146|4061147|4061148|4061149|4061150|4061151|4061152|4061153|4061154|4061155|4061156|4061157|4061158|4061159|4061160|4061161|4061162|4061163|4061164|4061165|4061166|4061167|4061168|4061169|4061170|4061171|4061172|4061173|4061174|4061175|4061176|4061177|4061178|4061179|4061180|4061181|4061182|4061183|4061184|4061185|4061186|4061187|4061188|4061189|4061190)/"
                ])
            ],[
                'label' => 'Banrural',
                'logo' => Null,
                'color' => json_encode(['Verde oscuro' => '#008E5C', 'Dorado' => '#DAA520']),
                'regEx' => json_encode([
                    1 => "/^(446542\d{10}(\d{3})?)|(446540\d{13})$/",
                    2 => "/^44654\d{12}(\d{3})?$/"
                ])
            ],[
                'label' => 'Visa BAM',
                'logo' => Null,
                'color' => json_encode(['Azul oscuro' => '#1A1F71', 'Blanco' => '#FFFFFF']),
                'regEx' => json_encode([
                    1 => "/^5[3-4][0-9]{14}$/",
                    2 => "/^5[3-4]\d{3}[\s\-]?\d{4}[\s\-]?\d{4}[\s\-]?\d{4}$/"
                ])
            ],[
                'label' => 'BAC San José',
                'logo' => Null,
                'color' => json_encode(['Verde oscuro' => '#009245', 'Dorado' => '#FDB813']),
                'regEx' => json_encode([
                    1 => "/^(4075|4088|4695|4911|4929)\d{12}$/"

                ])
            ],[
                'label' => 'BAC Banco Nacional de Costa Rica',
                'logo' => Null,
                'color' => json_encode(['Azul oscuro' => '#002663', 'Dorado' => '#FDB813']),
                'regEx' => json_encode([
                    1 => "/^(4102|4105)\d{12}$/",

                ])
            ],[
                'label' => 'Metropolitana',
                'logo' => Null,
                'color' => json_encode(['Rojo oscuro' => '#B50C1F', 'Dorado' => '#FDC02F']),
                'regEx' => json_encode([
                    1 => "/^6390\d{12}$/",

                ])
            ],[
                'label' => 'Red',
                'logo' => Null,
                'color' => json_encode(['Azul oscuro' => '#1A1F71', 'Naranja' => '#FF6600']),
                'regEx' => json_encode([
                    1 => "/^(6263|5048)\d{12}$/",

                ])
            ],[
                'label' => 'Cabal',
                'logo' => Null,
                'color' => json_encode(['Rojo oscuro' => '#9E0C0F', 'Dorado' => '#FFC72C']),
                'regEx' => json_encode([
                    1 => "/^(6042|6044)\d{12}$/",

                ])
            ],[
                'label' => 'Bandec',
                'logo' => Null,
                'color' => json_encode(['Verde oscuro' => '#006633', 'Dorado' => '#FFD700']),
                'regEx' => json_encode([
                    1 => "/^(4223|4224)\d{12}$/",

                ])
            ],[
                'label' => 'BPA',
                'logo' => Null,
                'color' => json_encode(['Azul oscuro' => '#0F1F2E', 'Dorado' => '#FFC72C']),
                'regEx' => json_encode([
                    1 => "/^(4368|5245)\d{12}$/",

                ])
            ]
        ]);
    }
}
