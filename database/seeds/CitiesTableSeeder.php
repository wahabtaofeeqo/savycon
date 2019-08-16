<?php

use Illuminate\Database\Seeder;

use SavyCon\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            '1' => ['Aba North', 'Aba South', 'Arochukwu', 'Bende', 'Ikwuano', 'Isiala-Ngwa North', 'Isiala-Ngwa South', 'Isuikwuato', 'Obi Ngwa', 'Ohafia', 'Osisioma Ngwa', 'Ugwunagbo', 'Ukwa East', 'Ukwa West', 'Umuahia North', 'Umuahia South', 'Umu Nneochi'],
            '2' => ['Demsa', 'Fufore', 'Ganye', 'Girei', 'Gombi', 'Guyuk', 'Hong', 'Jada', 'Lamurde', 'Madagali', 'Mayo-Belwa', 'Michika', 'Mubi North', 'Mubi South', 'Numan', 'Shelleng', 'Song', 'Toungo', 'Yola North', 'Yola South'],
            '3' => ['Abak', 'Eastern Obolo', 'Eket', 'Esit-Eket', 'Essien Udim', 'Etim-Ekpo', 'Etinan', 'Ibeno', 'Ibesikpo Asutan', 'Ibiono Ibom', 'Ika', 'Ikono', 'Ikot Abasi', 'Ikot Ekpene', 'Ini', 'Itu', 'Mbo', 'Mkpat Enin', 'Nsit Atai', 'Nsit Ibom', 'Nsit Ubium', 'Obot Akara', 'Okobo', 'Onna', 'Oron', 'Oruk Anam', 'Udung Uko', 'Ukanafun', 'Uquo-Ibeno', 'Uruan', 'Urue-Offong/Oruko', 'Uyo'],
            '4' => ['Aguata', 'Anambra East', 'Anambra West', 'Anaocha', 'Awka North', 'Awka South', 'Ayamelum', 'Dunukofia', 'Ekwusigo', 'Idemili North', 'Idemili South', 'Ihiala', 'Njikoka', 'Nnewi North', 'Nnewi South', 'Ogbaru', 'Onitsha North', 'Onitsha South', 'Orumba North', 'Orumba South', 'Oyi'],
            '5' => ['Alkaleri', 'Bauchi LGA', 'Bogoro', 'Damban', 'Darazo', 'Dass', 'Gamawa', 'Ganjuwa', 'Giade', 'Itas/Gadau', 'Jama\'are', 'Katagum', 'Kirfi', 'Misau', 'Shira', 'Toro', 'Warji', 'Zaki'],
            '6' => ['Brass', 'Ekeremor', 'Kolokuma/Opokuma', 'Nembe', 'Ogbia', 'Sagbama', 'Southern Ijaw', 'Yenagoa'],
            '7' => ['Ado', 'Agatu', 'Apa', 'Buruku', 'Gboko', 'Guma', 'Gwer East', 'Gwer West', 'Katsina-Ala', 'Kwande', 'Logo', 'Makurdi', 'Obi', 'Ogbadibo', 'Ohimini', 'Oju', 'Okpokwu', 'Otukpo', 'Tarka', 'Ukum', 'Ushongo', 'Vandeikya'],
            '8' => ['Abadam', 'Askira/Uba', 'Bama', 'Biu', 'Chibok', 'Damboa', 'Dikwa', 'Gubio', 'Guzamala', 'Gwoza', 'Jere', 'Konduga', 'Kukawa', 'Mafa', 'Magumeri', 'Maiduguri'],
            '9' => ['Abi', 'Akamkpa', 'Akpabuyo', 'Bakassi', 'Bekwara', 'Biase', 'Boki', 'Calabar-Municipal', 'Calabar South', 'Etung', 'Ikom', 'Obanliku', 'Obubra', 'Obudu', 'Odukpani', 'Ogoja', 'Yakuur', 'Yala'],
            '10' => ['Aniocha North', 'Aniocha South', 'Bomadi', 'Burutu', 'Ethiope East', 'Ethiope West', 'Ika North East', 'Ika South', 'Isoko North', 'Isoko South', 'Ndokwa East', 'Ndokwa West', 'Okpe', 'Oshimili North', 'Oshimili South', 'Patani', 'Sapele', 'Udu', 'Ughelli North', 'Ughelli South', 'Ukwuani', 'Uvwie', 'Warri North', 'Warri South', 'Warri South-West'],
            '11' => ['Abakaliki', 'Afikpo North', 'Afikpo South', 'Ebonyi', 'Ezza North', 'Ezza South', 'Ikwo', 'Ishielu', 'Ivo', 'Izzi', 'Ohaozara', 'Ohaukwu', 'Onicha'],
            '12' => ['Akoko-Edo', 'Egor', 'Esan Central', 'Esan North East', 'Esan South East', 'Esan West', 'Etsako Central', 'Etsako East', 'Etsako West', 'Igueben', 'Ikpoba-Okha', 'Oredo', 'Orhionmwon', 'Ovia North East', 'Ovia South West', 'Owan East', 'Owan West', 'Uhunmwonde'],
            '13' => ['Ado Ekiti', 'Efon', 'Ekiti East', 'Ekiti South West', 'Ekiti West', 'Emure', 'Ido-Osi', 'Ijero', 'Ikere', 'Ikole', 'Ilejemeje', 'Irepodun/Ifelodun', 'Ise/Orun', 'Moba', 'Oye'],
            '14' => ['Aninri', 'Awgu', 'Enugu East', 'Enugu North', 'Enugu South', 'Ezeagu', 'Igbo-Etiti', 'Igbo-Eze North', 'Igbo Eze South', 'Isi-Uzo', 'Nkanu East', 'Nkanu West', 'Nsukka', 'Oji-River', 'Udenu', 'Udi', 'Uzo-Uwani'],
            '15' => ['Abaji', 'Asokoro', 'Bwari', 'Central Business District', 'Chika', 'Dakidiya', 'Dakwo', 'Dei-Dei', 'Duboyi', 'Durumi', 'Dutse', 'Gaduwa', 'Galadimawa', 'Garki I', 'Garki II', 'Gudu', 'Guzape', 'Gwagwalada', 'Gwarinpa', 'Jabi', 'Jahi', 'Jukwoyi', 'Kabusa', 'Kado', 'Karmo', 'Karu', 'Katampe', 'Kaura', 'Kubwa', 'Kuchigworo', 'Kuje', 'Kwali', 'Lokogoma', 'Lugbe', 'Mabuchi', 'Maitama', 'Mpape', 'Nbora', 'Nyanya', 'Pyakassa', 'Utako', 'Wumba', 'Wuse', 'Wuse II', 'Wuye'],
            '16' => ['Akko', 'Balanga', 'Billiri', 'Dukku', 'Funakaye', 'Gombe LGA', 'Kaltungo', 'Kwami', 'Nafada', 'Shomgom', 'Yamaltu/Deba'],
            '17' => ['Aboh-Mbaise', 'Ahiazu-Mbaise', 'Ehime-Mbano', 'Ezinihitte', 'Ezinihitte Mbaise', 'Ideato North', 'Ideato South', 'Ihitte/Uboma', 'Ikeduru', 'Isiala Mbano', 'Isu', 'Mbaitoli', 'Ngor-Okpala', 'Njaba', 'Nkwerre', 'Nwangele', 'Obowo', 'Oguta', 'Ohaji/Egbema', 'Okigwe', 'Onuimo', 'Orlu', 'Orsu', 'Oru East', 'Oru West', 'Owerri-Municipal', 'Owerri North', 'Owerri West'],
            '18' => ['Babura', 'Biriniwa', 'Dutse-Jigawa', 'Gagarawa', 'Garki', 'Gumel', 'Hadejia', 'Jahun', 'Kaugama', 'Kazaure', 'Ringim', 'Sule-Tankarkar', 'Taura'],
            '19' => ['Birnin-Gwari', 'Chikun', 'Giwa', 'Igabi', 'Ikara', 'Jaba', 'Jema\'a', 'Kachia', 'Kaduna North', 'Kaduna South', 'Kagarko', 'Kajuru', 'Kaura-Kaduna', 'Kauru', 'Kubau', 'Kudan', 'Lere', 'Makarfi', 'Sanga', 'Soba', 'Zango-Kataf', 'Zaria'],
            '20' => ['Ajingi', 'Albasu', 'Bagwai', 'Bebeji', 'Bichi', 'Bunkure', 'Dala', 'Dambatta', 'Dawakin Kudu', 'Dawakin Tofa, Doguwa', 'Fagge', 'Gabasawa', 'Garko', 'Garum Mallam', 'Garun Mallam', 'Gaya', 'Gezawa', 'Gwale', 'Gwarzo', 'Kabo', 'Kano Municipal', 'Karaye', 'Kibiya', 'Kumbotso', 'Kunchi', 'Kura', 'Madobi', 'Makoda', 'Nasarawa-Kano', 'Rano', 'Rogo', 'Shanono', 'Sumaila', 'Tarauni', 'Tofa', 'Tudun Wada', 'Ungogo', 'Warawa', 'Wudil'],
            '21' => ['Bakori', 'Batagarawa', 'Batsari', 'Baure', 'Bindawa', 'Charanchi', 'Dandume', 'Danja', 'Dan Musa', 'Daura', 'Dutsi', 'Dutsin-Ma', 'Faskari', 'Funtua', 'Ingawa', 'Jibia', 'Kaita', 'Kankara', 'Katsina', 'Kurfi', 'Malumfashi', 'Mani', 'Musawa', 'Sabuwa', 'Safana', 'Sandamu', 'Zango'],
            '22' => ['Aleiro', 'Arewa-Dandi', 'Argungu', 'Augie', 'Bagudo', 'Birnin Kebbi', 'Bunza', 'Dandi', 'Fakai', 'Gwandu', 'Jega', 'Kalgo', 'Maiyama', 'Sakaba', 'Suru', 'Yauri', 'Zuru'],
            '23' => ['Adavi', 'Ajaokuta', 'Ankpa', 'Bassa', 'Dekina', 'Ibaji', 'Idah', 'Igala Mela', 'Igalamela-Odolu', 'Ijumu', 'Kabba/Bunu', 'Kogi LGA', 'Koton Karfe', 'Lokoja', 'Mopa-Muro', 'Ofu', 'Ogori/Magongo', 'Okehi', 'Okene, Olamaboro, Omala, Yagba East', 'Yagba West'],
            '24' => ['Asa', 'Baruten', 'Edu', 'Ekiti-Kwara', 'Ifelodun-Kwara', 'Ilorin East', 'Ilorin South', 'Ilorin West', 'Irepodun-Kwara', 'Isin', 'Kaiama', 'Moro', 'Offa', 'Oke-Ero', 'Oyun', 'Pategi'],
            '25' => ['Agboyi/Ketu', 'Agege', 'Ajah', 'Alimosho', 'Amuwo-Odofin', 'Apapa', 'Badagry', 'Egbe Idimu', 'Epe', 'Gbagada', 'Ibeju', 'Ifako-Ijaiye', 'Ikeja', 'Ikorodu', 'Ikotun/Igando', 'Ikoyi', 'Ilupeju', 'Ipaja', 'Isolo', 'Kosofe', 'Lagos Island', 'Lagos Mainland', 'Lekki Phase 1', 'Lekki Phase 2', 'Magodo', 'Maryland', 'Mushin', 'Ojo', 'Ojodu', 'Ojota', 'Orile', 'Oshodi-Isolo', 'Shomolu', 'Surulere', 'Victoria Island', 'Yaba'],
            '26' => ['Akwanga', 'Awe', 'Doma', 'Karu-Nasarawa', 'Keana', 'Keffi', 'Kokona', 'Lafia', 'Nasarawa', 'Nasarawa-Eggon', 'Obi-Nasarawa', 'Toto', 'Wamba'],
            '27' => ['Agaie', 'Agwara', 'Bida', 'Borgu', 'Bosso', 'Chanchaga', 'Edati', 'Gbako', 'Gurara', 'Katcha', 'Kontagora', 'Lapai', 'Lavun', 'Magama', 'Mariga', 'Mashegu', 'Minna', 'Mokwa', 'Muya', 'Paikoro', 'Rafi', 'Rijau', 'Shiroro', 'Suleja', 'Tafa', 'Wushishi'],
            '28' => ['Abeokuta North', 'Abeokuta South', 'Ado-Odo/Ota', 'Egbado North', 'Egbado South', 'Ewekoro', 'Ifo', 'Ijebu East', 'Ijebu North', 'Ijebu North East', 'Ijebu Ode', 'Ikenne', 'Imeko Afon', 'Ipokia', 'Obafemi-Owode', 'Odeda', 'Odogbolu', 'Waterside', 'Remo North', 'Sagamu'],
            '29' => ['Akoko North East', 'Akoko North West', 'Akoko South East', 'Akoko South West', 'Akure North', 'Akure South', 'Ese-Odo', 'Idanre', 'Ifedore', 'Ilaje', 'Ile-Oluji-Okeigbo', 'Irele', 'Odigbo', 'Okitipupa', 'Ondo East', 'Ondo West', 'Ose', 'Owo'],
            '30' => ['Aiyedade', 'Aiyedire', 'Atakumosa East', 'Atakumosa West', 'Boluwaduro', 'Boripe', 'Ede North', 'Ede South', 'Egbedore', 'Ife Central', 'Ifedayo', 'Ife East', 'Ifelodun-Osun', 'Ife North', 'Ife South', 'Ila', 'Ilesa East', 'Ilesa West', 'Irepodun-Osun', 'Irewole', 'Isokan', 'Iwo', 'Obokun', 'Ola-Oluwa', 'Olorunda-Osun', 'Oriade', 'Orolu', 'Osogbo'],
            '31' => ['Afijio', 'Akinyele', 'Atiba', 'Atigbo', 'Egbeda', 'Ibadan North', 'Ibadan North East', 'Ibadan North West', 'Ibadan South East', 'Ibadan South West', 'Ibarapa Central', 'Ibarapa East', 'Ibarapa North', 'Ido', 'Irepo', 'Iseyin', 'Itesiwaju', 'Iwajowa', 'Kajola', 'Lagelu', 'Ogbomosho North', 'Ogbomosho South', 'Ogo Oluwa', 'Olorunsogo', 'Oluyole', 'Ona-Ara', 'Orelope', 'Ori Ire', 'Oyo East', 'Oyo West', 'Saki East', 'Saki West', 'Surulere-Oyo'],
            '32' => ['Barkin Ladi', 'Bassa-Plateau', 'Bokkos', 'Jos East', 'Jos North', 'Jos South', 'Kanam', 'Kanke', 'Langtang North', 'Langtang South', 'Mangu', 'Mikang', 'Pankshin', 'Quaan Pan', 'Riyom', 'Shendam', 'Wase'],
            '33' => ['Abua/Odual', 'Ahoada East', 'Ahoada West', 'Akuku Toru', 'Andoni', 'Asari-Toru', 'Bonny', 'Degema', 'Eleme', 'Emohua', 'Etche', 'Gokana', 'Ikwerre', 'Khana', 'Obio-Akpor', 'Ogba/Egbema/Ndoni', 'Ogu/Bolo', 'Okrika', 'Omuma', 'Oyigbo', 'Port-Harcourt', 'Tai'],
            '34' => ['Binji', 'Bodinga', 'Dange-Shuni', 'Gada', 'Goronyo', 'Gudu LGA', 'Gwadabawa', 'Illela', 'Isa', 'Kebbe', 'Sabon Birni', 'Shagari', 'Silame', 'Sokoto North', 'Sokoto South', 'Tambuwal', 'Tangaza', 'Tureta', 'Wamako', 'Yabo'],
            '35' => ['Bali', 'Jalingo', 'Kurmi', 'Lau', 'Sardauna', 'Takum', 'Ussa', 'Wukari', 'Zing'],
            '36' => ['Bade', 'Bursari', 'Damaturu', 'Fika', 'Fune', 'Geidam', 'Nangere', 'Nguru', 'Potiskum', 'Tarmua', 'Yusufari'],
            '37' => ['Birnin Magaji', 'Bungudu', 'Gummi', 'Gusau', 'Kaura Namoda', 'Maru', 'Shinkafi', 'Talata Mafara', 'Zurmi'],
        ];

        foreach ($cities as $index => $city) {
            $state_id = $index;

            foreach ($city as $key) {
                City::insert([
                    'name' => $key,
                    'state_id' => $state_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
