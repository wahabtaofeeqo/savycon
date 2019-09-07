<?php

use Illuminate\Database\Seeder;

use SavyCon\Models\City;
use SavyCon\Models\State;

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
            'Abia' => ['Aba North', 'Aba South', 'Arochukwu', 'Bende', 'Ikwuano', 'Isiala-Ngwa North', 'Isiala-Ngwa South', 'Isuikwuato', 'Obi Ngwa', 'Ohafia', 'Osisioma Ngwa', 'Ugwunagbo', 'Ukwa East', 'Ukwa West', 'Umuahia North', 'Umuahia South', 'Umu Nneochi'],
            'Adamawa' => ['Demsa', 'Fufore', 'Ganye', 'Girei', 'Gombi', 'Guyuk', 'Hong', 'Jada', 'Lamurde', 'Madagali', 'Mayo-Belwa', 'Michika', 'Mubi North', 'Mubi South', 'Numan', 'Shelleng', 'Song', 'Toungo', 'Yola North', 'Yola South'],
            'Akwa-Ibom' => ['Abak', 'Eastern Obolo', 'Eket', 'Esit-Eket', 'Essien Udim', 'Etim-Ekpo', 'Etinan', 'Ibeno', 'Ibesikpo Asutan', 'Ibiono Ibom', 'Ika', 'Ikono', 'Ikot Abasi', 'Ikot Ekpene', 'Ini', 'Itu', 'Mbo', 'Mkpat Enin', 'Nsit Atai', 'Nsit Ibom', 'Nsit Ubium', 'Obot Akara', 'Okobo', 'Onna', 'Oron', 'Oruk Anam', 'Udung Uko', 'Ukanafun', 'Uquo-Ibeno', 'Uruan', 'Urue-Offong/Oruko', 'Uyo'],
            'Anambra' => ['Aguata', 'Anambra East', 'Anambra West', 'Anaocha', 'Awka North', 'Awka South', 'Ayamelum', 'Dunukofia', 'Ekwusigo', 'Idemili North', 'Idemili South', 'Ihiala', 'Njikoka', 'Nnewi North', 'Nnewi South', 'Ogbaru', 'Onitsha North', 'Onitsha South', 'Orumba North', 'Orumba South', 'Oyi'],
            'Bauchi' => ['Alkaleri', 'Bauchi LGA', 'Bogoro', 'Damban', 'Darazo', 'Dass', 'Gamawa', 'Ganjuwa', 'Giade', 'Itas/Gadau', 'Jama\'are', 'Katagum', 'Kirfi', 'Misau', 'Shira', 'Toro', 'Warji', 'Zaki'],
            'Bayelsa' => ['Brass', 'Ekeremor', 'Kolokuma/Opokuma', 'Nembe', 'Ogbia', 'Sagbama', 'Southern Ijaw', 'Yenagoa'],
            'Benue' => ['Ado', 'Agatu', 'Apa', 'Buruku', 'Gboko', 'Guma', 'Gwer East', 'Gwer West', 'Katsina-Ala', 'Kwande', 'Logo', 'Makurdi', 'Obi', 'Ogbadibo', 'Ohimini', 'Oju', 'Okpokwu', 'Otukpo', 'Tarka', 'Ukum', 'Ushongo', 'Vandeikya'],
            'Borno' => ['Abadam', 'Askira/Uba', 'Bama', 'Biu', 'Chibok', 'Damboa', 'Dikwa', 'Gubio', 'Guzamala', 'Gwoza', 'Jere', 'Konduga', 'Kukawa', 'Mafa', 'Magumeri', 'Maiduguri'],
            'Cross-River' => ['Abi', 'Akamkpa', 'Akpabuyo', 'Bakassi', 'Bekwara', 'Biase', 'Boki', 'Calabar-Municipal', 'Calabar South', 'Etung', 'Ikom', 'Obanliku', 'Obubra', 'Obudu', 'Odukpani', 'Ogoja', 'Yakuur', 'Yala'],
            'Delta' => ['Aniocha North', 'Aniocha South', 'Bomadi', 'Burutu', 'Ethiope East', 'Ethiope West', 'Ika North East', 'Ika South', 'Isoko North', 'Isoko South', 'Ndokwa East', 'Ndokwa West', 'Okpe', 'Oshimili North', 'Oshimili South', 'Patani', 'Sapele', 'Udu', 'Ughelli North', 'Ughelli South', 'Ukwuani', 'Uvwie', 'Warri North', 'Warri South', 'Warri South-West'],
            'Ebonyi' => ['Abakaliki', 'Afikpo North', 'Afikpo South', 'Ebonyi', 'Ezza North', 'Ezza South', 'Ikwo', 'Ishielu', 'Ivo', 'Izzi', 'Ohaozara', 'Ohaukwu', 'Onicha'],
            'Edo' => ['Akoko-Edo', 'Egor', 'Esan Central', 'Esan North East', 'Esan South East', 'Esan West', 'Etsako Central', 'Etsako East', 'Etsako West', 'Igueben', 'Ikpoba-Okha', 'Oredo', 'Orhionmwon', 'Ovia North East', 'Ovia South West', 'Owan East', 'Owan West', 'Uhunmwonde'],
            'Ekiti' => ['Ado Ekiti', 'Efon', 'Ekiti East', 'Ekiti South West', 'Ekiti West', 'Emure', 'Ido-Osi', 'Ijero', 'Ikere', 'Ikole', 'Ilejemeje', 'Irepodun/Ifelodun', 'Ise/Orun', 'Moba', 'Oye'],
            'Enugu' => ['Aninri', 'Awgu', 'Enugu East', 'Enugu North', 'Enugu South', 'Ezeagu', 'Igbo-Etiti', 'Igbo-Eze North', 'Igbo Eze South', 'Isi-Uzo', 'Nkanu East', 'Nkanu West', 'Nsukka', 'Oji-River', 'Udenu', 'Udi', 'Uzo-Uwani'],
            'Abuja' => ['Abaji', 'Asokoro', 'Bwari', 'Central Business District', 'Chika', 'Dakidiya', 'Dakwo', 'Dei-Dei', 'Duboyi', 'Durumi', 'Dutse', 'Gaduwa', 'Galadimawa', 'Garki I', 'Garki II', 'Gudu', 'Guzape', 'Gwagwalada', 'Gwarinpa', 'Jabi', 'Jahi', 'Jukwoyi', 'Kabusa', 'Kado', 'Karmo', 'Karu', 'Katampe', 'Kaura', 'Kubwa', 'Kuchigworo', 'Kuje', 'Kwali', 'Lokogoma', 'Lugbe', 'Mabuchi', 'Maitama', 'Mpape', 'Nbora', 'Nyanya', 'Pyakassa', 'Utako', 'Wumba', 'Wuse', 'Wuse II', 'Wuye'],
            'Gombe' => ['Akko', 'Balanga', 'Billiri', 'Dukku', 'Funakaye', 'Gombe LGA', 'Kaltungo', 'Kwami', 'Nafada', 'Shomgom', 'Yamaltu/Deba'],
            'Imo' => ['Aboh-Mbaise', 'Ahiazu-Mbaise', 'Ehime-Mbano', 'Ezinihitte', 'Ezinihitte Mbaise', 'Ideato North', 'Ideato South', 'Ihitte/Uboma', 'Ikeduru', 'Isiala Mbano', 'Isu', 'Mbaitoli', 'Ngor-Okpala', 'Njaba', 'Nkwerre', 'Nwangele', 'Obowo', 'Oguta', 'Ohaji/Egbema', 'Okigwe', 'Onuimo', 'Orlu', 'Orsu', 'Oru East', 'Oru West', 'Owerri-Municipal', 'Owerri North', 'Owerri West'],
            'Jigawa' => ['Babura', 'Biriniwa', 'Dutse-Jigawa', 'Gagarawa', 'Garki', 'Gumel', 'Hadejia', 'Jahun', 'Kaugama', 'Kazaure', 'Ringim', 'Sule-Tankarkar', 'Taura'],
            'Kaduna' => ['Birnin-Gwari', 'Chikun', 'Giwa', 'Igabi', 'Ikara', 'Jaba', 'Jema\'a', 'Kachia', 'Kaduna North', 'Kaduna South', 'Kagarko', 'Kajuru', 'Kaura-Kaduna', 'Kauru', 'Kubau', 'Kudan', 'Lere', 'Makarfi', 'Sanga', 'Soba', 'Zango-Kataf', 'Zaria'],
            'Kano' => ['Ajingi', 'Albasu', 'Bagwai', 'Bebeji', 'Bichi', 'Bunkure', 'Dala', 'Dambatta', 'Dawakin Kudu', 'Dawakin Tofa, Doguwa', 'Fagge', 'Gabasawa', 'Garko', 'Garum Mallam', 'Garun Mallam', 'Gaya', 'Gezawa', 'Gwale', 'Gwarzo', 'Kabo', 'Kano Municipal', 'Karaye', 'Kibiya', 'Kumbotso', 'Kunchi', 'Kura', 'Madobi', 'Makoda', 'Nasarawa-Kano', 'Rano', 'Rogo', 'Shanono', 'Sumaila', 'Tarauni', 'Tofa', 'Tudun Wada', 'Ungogo', 'Warawa', 'Wudil'],
            'Katsina' => ['Bakori', 'Batagarawa', 'Batsari', 'Baure', 'Bindawa', 'Charanchi', 'Dandume', 'Danja', 'Dan Musa', 'Daura', 'Dutsi', 'Dutsin-Ma', 'Faskari', 'Funtua', 'Ingawa', 'Jibia', 'Kaita', 'Kankara', 'Katsina', 'Kurfi', 'Malumfashi', 'Mani', 'Musawa', 'Sabuwa', 'Safana', 'Sandamu', 'Zango'],
            'Kebbi' => ['Aleiro', 'Arewa-Dandi', 'Argungu', 'Augie', 'Bagudo', 'Birnin Kebbi', 'Bunza', 'Dandi', 'Fakai', 'Gwandu', 'Jega', 'Kalgo', 'Maiyama', 'Sakaba', 'Suru', 'Yauri', 'Zuru'],
            'Kogi' => ['Adavi', 'Ajaokuta', 'Ankpa', 'Bassa', 'Dekina', 'Ibaji', 'Idah', 'Igala Mela', 'Igalamela-Odolu', 'Ijumu', 'Kabba/Bunu', 'Kogi LGA', 'Koton Karfe', 'Lokoja', 'Mopa-Muro', 'Ofu', 'Ogori/Magongo', 'Okehi', 'Okene, Olamaboro, Omala, Yagba East', 'Yagba West'],
            'Kwara' => ['Asa', 'Baruten', 'Edu', 'Ekiti-Kwara', 'Ifelodun-Kwara', 'Ilorin East', 'Ilorin South', 'Ilorin West', 'Irepodun-Kwara', 'Isin', 'Kaiama', 'Moro', 'Offa', 'Oke-Ero', 'Oyun', 'Pategi'],
            'Lagos' => ['Agboyi/Ketu', 'Agege', 'Ajah', 'Alimosho', 'Amuwo-Odofin', 'Apapa', 'Badagry', 'Egbe Idimu', 'Epe', 'Gbagada', 'Ibeju', 'Ifako-Ijaiye', 'Ikeja', 'Ikorodu', 'Ikotun/Igando', 'Ikoyi', 'Ilupeju', 'Ipaja', 'Isolo', 'Kosofe', 'Lagos Island', 'Lagos Mainland', 'Lekki Phase 1', 'Lekki Phase 2', 'Magodo', 'Maryland', 'Mushin', 'Ojo', 'Ojodu', 'Ojota', 'Orile', 'Oshodi-Isolo', 'Shomolu', 'Surulere', 'Victoria Island', 'Yaba'],
            'Nasarawa' => ['Akwanga', 'Awe', 'Doma', 'Karu-Nasarawa', 'Keana', 'Keffi', 'Kokona', 'Lafia', 'Nasarawa', 'Nasarawa-Eggon', 'Obi-Nasarawa', 'Toto', 'Wamba'],
            'Niger' => ['Agaie', 'Agwara', 'Bida', 'Borgu', 'Bosso', 'Chanchaga', 'Edati', 'Gbako', 'Gurara', 'Katcha', 'Kontagora', 'Lapai', 'Lavun', 'Magama', 'Mariga', 'Mashegu', 'Minna', 'Mokwa', 'Muya', 'Paikoro', 'Rafi', 'Rijau', 'Shiroro', 'Suleja', 'Tafa', 'Wushishi'],
            'Ogun' => ['Abeokuta North', 'Abeokuta South', 'Ado-Odo/Ota', 'Egbado North', 'Egbado South', 'Ewekoro', 'Ifo', 'Ijebu East', 'Ijebu North', 'Ijebu North East', 'Ijebu Ode', 'Ikenne', 'Imeko Afon', 'Ipokia', 'Obafemi-Owode', 'Odeda', 'Odogbolu', 'Waterside', 'Remo North', 'Sagamu'],
            'Ondo' => ['Akoko North East', 'Akoko North West', 'Akoko South East', 'Akoko South West', 'Akure North', 'Akure South', 'Ese-Odo', 'Idanre', 'Ifedore', 'Ilaje', 'Ile-Oluji-Okeigbo', 'Irele', 'Odigbo', 'Okitipupa', 'Ondo East', 'Ondo West', 'Ose', 'Owo'],
            'Osun' => ['Aiyedade', 'Aiyedire', 'Atakumosa East', 'Atakumosa West', 'Boluwaduro', 'Boripe', 'Ede North', 'Ede South', 'Egbedore', 'Ife Central', 'Ifedayo', 'Ife East', 'Ifelodun-Osun', 'Ife North', 'Ife South', 'Ila', 'Ilesa East', 'Ilesa West', 'Irepodun-Osun', 'Irewole', 'Isokan', 'Iwo', 'Obokun', 'Ola-Oluwa', 'Olorunda-Osun', 'Oriade', 'Orolu', 'Osogbo'],
            'Oyo' => ['Afijio', 'Akinyele', 'Atiba', 'Atigbo', 'Egbeda', 'Ibadan North', 'Ibadan North East', 'Ibadan North West', 'Ibadan South East', 'Ibadan South West', 'Ibarapa Central', 'Ibarapa East', 'Ibarapa North', 'Ido', 'Irepo', 'Iseyin', 'Itesiwaju', 'Iwajowa', 'Kajola', 'Lagelu', 'Ogbomosho North', 'Ogbomosho South', 'Ogo Oluwa', 'Olorunsogo', 'Oluyole', 'Ona-Ara', 'Orelope', 'Ori Ire', 'Oyo East', 'Oyo West', 'Saki East', 'Saki West', 'Surulere-Oyo'],
            'Plateau' => ['Barkin Ladi', 'Bassa-Plateau', 'Bokkos', 'Jos East', 'Jos North', 'Jos South', 'Kanam', 'Kanke', 'Langtang North', 'Langtang South', 'Mangu', 'Mikang', 'Pankshin', 'Quaan Pan', 'Riyom', 'Shendam', 'Wase'],
            'Rivers' => ['Abua/Odual', 'Ahoada East', 'Ahoada West', 'Akuku Toru', 'Andoni', 'Asari-Toru', 'Bonny', 'Degema', 'Eleme', 'Emohua', 'Etche', 'Gokana', 'Ikwerre', 'Khana', 'Obio-Akpor', 'Ogba/Egbema/Ndoni', 'Ogu/Bolo', 'Okrika', 'Omuma', 'Oyigbo', 'Port-Harcourt', 'Tai'],
            'Sokoto' => ['Binji', 'Bodinga', 'Dange-Shuni', 'Gada', 'Goronyo', 'Gudu LGA', 'Gwadabawa', 'Illela', 'Isa', 'Kebbe', 'Sabon Birni', 'Shagari', 'Silame', 'Sokoto North', 'Sokoto South', 'Tambuwal', 'Tangaza', 'Tureta', 'Wamako', 'Yabo'],
            'Taraba' => ['Bali', 'Jalingo', 'Kurmi', 'Lau', 'Sardauna', 'Takum', 'Ussa', 'Wukari', 'Zing'],
            'Yobe' => ['Bade', 'Bursari', 'Damaturu', 'Fika', 'Fune', 'Geidam', 'Nangere', 'Nguru', 'Potiskum', 'Tarmua', 'Yusufari'],
            'Zamfara' => ['Birnin Magaji', 'Bungudu', 'Gummi', 'Gusau', 'Kaura Namoda', 'Maru', 'Shinkafi', 'Talata Mafara', 'Zurmi'],
        ];

        foreach ($cities as $index => $city) {
            $state_id = State::where('name', $index)->first()->id;

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
