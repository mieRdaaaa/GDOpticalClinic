document.addEventListener('DOMContentLoaded', function() {
    loadRegions();
    document.getElementById('region').addEventListener('change', loadProvinces);
    document.getElementById('province').addEventListener('change', loadCities);
    document.getElementById('city').addEventListener('change', loadBarangays);
});

function loadRegions() {
    const regions = [
        { id: 1, name: 'Region I – Ilocos Region' },
        { id: 2, name: 'Region II – Cagayan Valley' },
        { id: 3, name: 'Region III – Central Luzon' },
        { id: 4, name: 'Region IV-A – CALABARZON' },
        { id: 5, name: 'MIMAROPA Region' },
        { id: 6, name: 'Region V – Bicol Region' },
        { id: 7, name: 'Region VI – Western Visayas' },
        { id: 8, name: 'Region VII – Central Visayas' },
        { id: 9, name: 'Region VIII – Eastern Visayas' },
        { id: 10, name: 'Region IX – Zamboanga Peninsula' },
        { id: 11, name: 'Region X – Northern Mindanao' },
        { id: 12, name: 'Region XI – Davao Region' },
        { id: 13, name: 'Region XII – SOCCSKSARGEN' },
        { id: 14, name: 'Region XIII – Caraga' },
        { id: 15, name: 'NCR – National Capital Region' },
        { id: 16, name: 'CAR – Cordillera Administrative Region' },
        { id: 17, name: 'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao' }
    ];

    let regionSelect = document.getElementById('region');
    regionSelect.innerHTML = '<option value="">Select Region</option>';  // Reset options
    regions.forEach(region => {
        let option = document.createElement('option');
        option.value = region.name;  // Using the name as the value
        option.text = region.name;
        regionSelect.appendChild(option);
    });
}

function loadProvinces() {
    const provinces = {
        'Region I – Ilocos Region': [
            { id: 101, name: 'Ilocos Norte' },
            { id: 102, name: 'Ilocos Sur' },
            { id: 103, name: 'La Union' },
            { id: 104, name: 'Pangasinan' }
        ],
        'Region II – Cagayan Valley': [
            { id: 201, name: 'Batanes' },
            { id: 202, name: 'Cagayan' },
            { id: 203, name: 'Isabela' },
            { id: 204, name: 'Nueva Vizcaya' },
            { id: 205, name: 'Quirino' },
        ],
        'Region III – Central Luzon': [
            { id: 301, name: 'Aurora' },
            { id: 302, name: 'Bataan' },
            { id: 303, name: 'Bulacan' },
            { id: 304, name: 'Nueva Ecija' },
            { id: 305, name: 'Pampanga' },
            { id: 306, name: 'Tarlac' },
            { id: 307, name: 'Zambales' }
        ],
        'Region IV-A – CALABARZON' : [
            { id: 401, name: 'Batangas' },
            { id: 402, name: 'Cavite' },
            { id: 403, name: 'Laguna' },
            { id: 404, name: 'Quezon' },
            { id: 405, name: 'Rizal' }
        ],
        'MIMAROPA Region' : [
            { id: 501, name: 'Marinduque' },
            { id: 502, name: 'Occidental Mindoro' },
            { id: 503, name: 'Oriental Mindoro' },
            { id: 504, name: 'Palawan' },
            { id: 505, name: 'Romblon' }
        ],
        'Region V – Bicol Region' : [
    { id: 601, name: 'Albay' },
    { id: 602, name: 'Camarines Norte' },
    { id: 603, name: 'Camarines Sur' },
    { id: 604, name: 'Catanduanes' },
    { id: 605, name: 'Masbate' },
    { id: 606, name: 'Sorsogon' }
],
'Region VI – Western Visayas' : [
    { id: 701, name: 'Aklan' },
    { id: 702, name: 'Antique' },
    { id: 703, name: 'Capiz' },
    { id: 704, name: 'Guimaras' },
    { id: 705, name: 'Iloilo' },
    { id: 706, name: 'Negros Occidental' }
],
'Region VII – Central Visayas' : [
    { id: 801, name: 'Bohol' },
    { id: 802, name: 'Cebu' },
    { id: 803, name: 'Negros Oriental' },
    { id: 804, name: 'Siquijor' }
],
'Region VIII – Eastern Visayas' : [
    { id: 901, name: 'Biliran' },
    { id: 902, name: 'Eastern Samar' },
    { id: 903, name: 'Leyte' },
    { id: 904, name: 'Northern Samar' },
    { id: 905, name: 'Samar (Western Samar)' },
    { id: 906, name: 'Southern Leyte' }
],
'Region IX – Zamboanga Peninsula' : [
    { id: 1001, name: 'Zamboanga del Norte' },
    { id: 1002, name: 'Zamboanga del Sur' },
    { id: 1003, name: 'Zamboanga Sibugay' }
],
 'Region X – Northern Mindanao' : [
    { id: 1101, name: 'Bukidnon' },
    { id: 1102, name: 'Camiguin' },
    { id: 1103, name: 'Lanao del Norte' },
    { id: 1104, name: 'Misamis Occidental' },
    { id: 1105, name: 'Misamis Oriental' }
],
'Region XI – Davao Region' : [
    { id: 1201, name: 'Davao de Oro' },
    { id: 1202, name: 'Davao del Norte' },
    { id: 1203, name: 'Davao del Sur' },
    { id: 1204, name: 'Davao Occidental' },
    { id: 1205, name: 'Davao Oriental' }
],
'Region XII – SOCCSKSARGEN' : [
    { id: 1301, name: 'North Cotabato' },
    { id: 1302, name: 'Sarangani' },
    { id: 1303, name: 'South Cotabato' },
    { id: 1304, name: 'Sultan Kudarat' }
],
'Region XIII – Caraga' : [
    { id: 1401, name: 'Agusan del Norte' },
    { id: 1402, name: 'Agusan del Sur' },
    { id: 1403, name: 'Dinagat Islands' },
    { id: 1404, name: 'Surigao del Norte' },
    { id: 1405, name: 'Surigao del Sur' }
],
'NCR – National Capital Region' : [
    { id: 1501, name: 'Metro Manila' }
],
'CAR – Cordillera Administrative Region' : [
    { id: 1601, name: 'Abra' },
    { id: 1602, name: 'Apayao' },
    { id: 1603, name: 'Benguet' },
    { id: 1604, name: 'Ifugao' },
    { id: 1605, name: 'Kalinga' },
    { id: 1606, name: 'Mountain Province' }
],
'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao' : [
    { id: 1701, name: 'Basilan' },
    { id: 1702, name: 'Lanao del Sur' },
    { id: 1703, name: 'Maguindanao' },
    { id: 1704, name: 'Sulu' },
    { id: 1705, name: 'Tawi-Tawi' }
]

    };

    let provinceSelect = document.getElementById('province');
    let regionName = document.getElementById('region').value;

    provinceSelect.innerHTML = '<option value="">Select Province</option>';  // Reset options
    if (regionName && provinces[regionName]) {
        provinces[regionName].forEach(province => {
            let option = document.createElement('option');
            option.value = province.name;  // Set value to the province name
            option.text = province.name;
            provinceSelect.appendChild(option);
        });
    }
}

function loadCities() {
    const cities = {
        // Region I - Ilocos Region
        'Ilocos Norte' : [
            { id: 1011, name: 'Laoag City' },
            { id: 1012, name: 'Batac City' },
            { id: 1013, name: 'Adams' },
            { id: 1014, name: 'Bacarra' },
            { id: 1015, name: 'Badoc' },
            { id: 1016, name: 'Bangui' },
            { id: 1017, name: 'Banna' },
            { id: 1018, name: 'Burgos' },
            { id: 1019, name: 'Carasi' },
            { id: 1020, name: 'Currimao' },
            { id: 1021, name: 'Dingras' },
            { id: 1022, name: 'Dumalneg' },
            { id: 1023, name: 'Marcos' },
            { id: 1024, name: 'Nueva Era' },
            { id: 1025, name: 'Pagudpud' },
            { id: 1026, name: 'Paoay' },
            { id: 1027, name: 'Pasuquin' },
            { id: 1028, name: 'Piddig' },
            { id: 1029, name: 'Pinili' },
            { id: 1030, name: 'Santa Ana' },
            { id: 1031, name: 'Santa Catalina' },
            { id: 1032, name: 'Santa Cruz' },
            { id: 1033, name: 'Santa Maria' },
            { id: 1034, name: 'Sarrat' },
            { id: 1035, name: 'Solsona' },
            { id: 1036, name: 'Vintar' }
        ],
        'Ilocos Sur' : [
            { id: 1021, name: 'Vigan City' },
            { id: 1022, name: 'Candon City' },
            { id: 1023, name: 'Cabugao' },
            { id: 1024, name: 'Concordia' },
            { id: 1025, name: 'Galimuyod' },
            { id: 1026, name: 'Gregorio del Pilar' },
            { id: 1027, name: 'Magsingal' },
            { id: 1028, name: 'Nagbukel' },
            { id: 1029, name: 'Narvacan' },
            { id: 1030, name: 'Quirino' },
            { id: 1031, name: 'Salcedo' },
            { id: 1032, name: 'San Emilio' },
            { id: 1033, name: 'San Esteban' },
            { id: 1034, name: 'San Ildefonso' },
            { id: 1035, name: 'San Juan' },
            { id: 1036, name: 'San Vicente' },
            { id: 1037, name: 'Santa Catalina' },
            { id: 1038, name: 'Santa Cruz' },
            { id: 1039, name: 'Santa Lucia' },
            { id: 1040, name: 'Santa Maria' },
            { id: 1041, name: 'Santiago' },
            { id: 1042, name: 'Sinait' },
            { id: 1043, name: 'Suyo' },
            { id: 1044, name: 'Tagudin' }
        ],
        'La Union' : [
            { id: 1031, name: 'San Fernando City' },
            { id: 1032, name: 'Agoo' },
            { id: 1033, name: 'Aringay' },
            { id: 1034, name: 'Bacnotan' },
            { id: 1035, name: 'Bagulin' },
            { id: 1036, name: 'Balaoan' },
            { id: 1037, name: 'Bangar' },
            { id: 1038, name: 'Bauang' },
            { id: 1039, name: 'Burgos' },
            { id: 1040, name: 'Caba' },
            { id: 1041, name: 'Luna' },
            { id: 1042, name: 'Naguilian' },
            { id: 1043, name: 'Pugo' },
            { id: 1044, name: 'Rosario' },
            { id: 1045, name: 'San Gabriel' },
            { id: 1046, name: 'San Juan' },
            { id: 1047, name: 'San Luis' },
            { id: 1048, name: 'San Mariano' },
            { id: 1049, name: 'San Nicolas' },
            { id: 1050, name: 'San Quirico' },
            { id: 1051, name: 'Santol' },
            { id: 1052, name: 'Santo Tomas' },
            { id: 1053, name: 'Sison' },
            { id: 1054, name: 'Sudipen' }
        ],
        'Pangasinan' : [
            { id: 1041, name: 'Dagupan City' },
            { id: 1042, name: 'San Carlos City' },
            { id: 1043, name: 'Urdaneta City' },
            { id: 1044, name: 'Agno' },
            { id: 1045, name: 'Aguilar' },
            { id: 1046, name: 'Alaminos' },
            { id: 1047, name: 'Anda' },
            { id: 1048, name: 'Asingan' },
            { id: 1049, name: 'Balungao' },
            { id: 1050, name: 'Bani' },
            { id: 1051, name: 'Basista' },
            { id: 1052, name: 'Bayambang' },
            { id: 1053, name: 'Binalonan' },
            { id: 1054, name: 'Binmaley' },
            { id: 1055, name: 'Bolinao' },
            { id: 1056, name: 'Bugallon' },
            { id: 1057, name: 'Burgos' },
            { id: 1058, name: 'Calasiao' },
            { id: 1059, name: 'Dasol' },
            { id: 1060, name: 'Infanta' },
            { id: 1061, name: 'Labrador' },
            { id: 1062, name: 'Lingayen' },
            { id: 1063, name: 'Manaoag' },
            { id: 1064, name: 'Mangaldan' },
            { id: 1065, name: 'Mangatarem' },
            { id: 1066, name: 'Natividad' },
            { id: 1067, name: 'Pozorrubio' },
            { id: 1068, name: 'Rosales' },
            { id: 1069, name: 'San Fabian' },
            { id: 1070, name: 'San Jacinto' },
            { id: 1071, name: 'San Manuel' },
            { id: 1072, name: 'San Nicolas' },
            { id: 1073, name: 'San Quintin' },
            { id: 1074, name: 'Santa Barbara' },
            { id: 1075, name: 'Santa Maria' },
            { id: 1076, name: 'Santo Tomas' },
            { id: 1077, name: 'Sison' },
            { id: 1078, name: 'Tayug' },
            { id: 1079, name: 'Umingan' },
            { id: 1080, name: 'Urbiztondo' },
            { id: 1081, name: 'Villasis' }
        ],
        

        // Region II - Cagayan Valley
        'Batanes' : [
            { id: 2011, name: 'Basco' },
            { id: 2012, name: 'Itbayat' },
            { id: 2013, name: 'Sabtang' },
            { id: 2014, name: 'Uyugan' }
        ],
        'Cagayan' : [
            { id: 2021, name: 'Tuguegarao City' },
            { id: 2022, name: 'Cauayan City' },
            { id: 2023, name: 'Abulug' },
            { id: 2024, name: 'Alcala' },
            { id: 2025, name: 'Allacapan' },
            { id: 2026, name: 'Amulung' },
            { id: 2027, name: 'Aparri' },
            { id: 2028, name: 'Baggao' },
            { id: 2029, name: 'Ballesteros' },
            { id: 2030, name: 'Buguey' },
            { id: 2031, name: 'Calayan' },
            { id: 2032, name: 'Camalaniugan' },
            { id: 2033, name: 'Claveria' },
            { id: 2034, name: 'Enrile' },
            { id: 2035, name: 'Gonzaga' },
            { id: 2036, name: 'Iguig' },
            { id: 2037, name: 'Lasam' },
            { id: 2038, name: 'Lallo' },
            { id: 2039, name: 'Lal-lo' },
            { id: 2040, name: 'Sanchez Mira' },
            { id: 2041, name: 'Santa Ana' },
            { id: 2042, name: 'Santa Cruz' },
            { id: 2043, name: 'Santa Teresita' },
            { id: 2044, name: 'Santo Niño' },
            { id: 2045, name: 'Solana' },
            { id: 2046, name: 'Tuao' }
        ],
        'Isabela' : [
            { id: 2031, name: 'Ilagan City' },
            { id: 2032, name: 'Santiago City' },
            { id: 2033, name: 'Alfonso Castañeda' },
            { id: 2034, name: 'Angadanan' },
            { id: 2035, name: 'Aurora' },
            { id: 2036, name: 'Benito Soliven' },
            { id: 2037, name: 'Cabagan' },
            { id: 2038, name: 'Cabatuan' },
            { id: 2039, name: 'Delfin Albano' },
            { id: 2040, name: 'Dinapigue' },
            { id: 2041, name: 'Echague' },
            { id: 2042, name: 'Gamu' },
            { id: 2043, name: 'Jones' },
            { id: 2044, name: 'Naguilian' },
            { id: 2045, name: 'Palanan' },
            { id: 2046, name: 'San Agustin' },
            { id: 2047, name: 'San Guillermo' },
            { id: 2048, name: 'San Isidro' },
            { id: 2049, name: 'San Mateo' },
            { id: 2050, name: 'San Mariano' },
            { id: 2051, name: 'San Pablo' },
            { id: 2052, name: 'San Pedro' },
            { id: 2053, name: 'San Rafael' },
            { id: 2054, name: 'San Tomas' },
            { id: 2055, name: 'Santo Tomas' },
            { id: 2056, name: 'Tumauini' }
        ],
        'Nueva Vizcaya' : [
            { id: 2041, name: 'Bayombong' },
            { id: 2042, name: 'Solano' },
            { id: 2043, name: 'Ambaguio' },
            { id: 2044, name: 'Bagabag' },
            { id: 2045, name: 'Burgos' },
            { id: 2046, name: 'Dupax del Norte' },
            { id: 2047, name: 'Dupax del Sur' },
            { id: 2048, name: 'Kasibu' },
            { id: 2049, name: 'Kayapa' },
            { id: 2050, name: 'Quezon' },
            { id: 2051, name: 'Villaverde' }
        ],
        'Quirino' : [
            { id: 2051, name: 'Cabarroguis' },
            { id: 2052, name: 'Aglipay' },
            { id: 2053, name: 'Diffun' },
            { id: 2054, name: 'Maddela' },
            { id: 2055, name: 'Nagtipunan' },
            { id: 2056, name: 'Saguday' },
            { id: 2057, name: 'Santiago' }
        ],        

        // Region III - Central Luzon
        'Aurora' : [
            { id: 3011, name: 'Baler' },
            { id: 3012, name: 'Casiguran' },
            { id: 3013, name: 'Dingalan' },
            { id: 3014, name: 'Dipaculao' },
            { id: 3015, name: 'Maria Aurora' },
            { id: 3016, name: 'San Luis' },
            { id: 3017, name: 'San Nicolas' },
            { id: 3018, name: 'San Juan' }
        ],
        'Bataan' : [
            { id: 3021, name: 'Balanga City' },
            { id: 3022, name: 'Mariveles' },
            { id: 3023, name: 'Limay' },
            { id: 3024, name: 'Orion' },
            { id: 3025, name: 'Pilar' },
            { id: 3026, name: 'Samal' },
            { id: 3027, name: 'Abucay' },
            { id: 3028, name: 'Bagac' },
            { id: 3029, name: 'Dinalupihan' },
            { id: 3030, name: 'Hermosa' },
            { id: 3031, name: 'Orani' }
        ],
       'Bulacan' : [
            { id: 3031, name: 'Malolos City' },
            { id: 3032, name: 'Meycauayan City' },
            { id: 3033, name: 'San Jose del Monte City' },
            { id: 3034, name: 'Bustos' },
            { id: 3035, name: 'Calumpit' },
            { id: 3036, name: 'Guiguinto' },
            { id: 3037, name: 'Hagonoy' },
            { id: 3038, name: 'Balagtas' },
            { id: 3039, name: 'Bocaue' },
            { id: 3040, name: 'Bulakan' },
            { id: 3041, name: 'Marilao' },
            { id: 3042, name: 'Norzagaray' },
            { id: 3043, name: 'Obando' },
            { id: 3044, name: 'Pandi' },
            { id: 3045, name: 'Paombong' },
            { id: 3046, name: 'Plaridel' },
            { id: 3047, name: 'San Ildefonso' },
            { id: 3048, name: 'San Miguel' },
            { id: 3049, name: 'San Rafael' },
            { id: 3050, name: 'San Simon' },
            { id: 3051, name: 'Santa Maria' }
        ],
        'Nueva Ecija' : [
            { id: 3041, name: 'Cabanatuan City' },
            { id: 3042, name: 'Gapan City' },
            { id: 3043, name: 'San Jose City' },
            { id: 3044, name: 'Aliaga' },
            { id: 3045, name: 'Bongabon' },
            { id: 3046, name: 'Cabiao' },
            { id: 3047, name: 'Carranglan' },
            { id: 3048, name: 'Cuyapo' },
            { id: 3049, name: 'General Tinio' },
            { id: 3050, name: 'Guimba' },
            { id: 3051, name: 'Jaen' },
            { id: 3052, name: 'Llanera' },
            { id: 3053, name: 'Licab' },
            { id: 3054, name: 'Lupao' },
            { id: 3055, name: 'Nampicuan' },
            { id: 3056, name: 'Pantabangan' },
            { id: 3057, name: 'Quezon' },
            { id: 3058, name: 'Rizal' },
            { id: 3059, name: 'San Antonio' },
            { id: 3060, name: 'San Isidro' },
            { id: 3061, name: 'San Leonardo' },
            { id: 3062, name: 'San Jose City' },
            { id: 3063, name: 'San Juan' },
            { id: 3064, name: 'San Nicolas' },
            { id: 3065, name: 'San Rafael' },
            { id: 3066, name: 'Santa Rosa' },
            { id: 3067, name: 'Santo Domingo' },
            { id: 3068, name: 'Santo Tomas' },
            { id: 3069, name: 'Talavera' },
            { id: 3070, name: 'Talugtug' },
            { id: 3071, name: 'Zaragoza' }
        ],
        'Pampanga' : [
            { id: 3051, name: 'San Fernando City' },
            { id: 3052, name: 'Angeles City' },
            { id: 3053, name: 'Mabalacat City' },
            { id: 3054, name: 'Apalit' },
            { id: 3055, name: 'Bacolor' },
            { id: 3056, name: 'Candaba' },
            { id: 3057, name: 'Floridablanca' },
            { id: 3058, name: 'Guagua' },
            { id: 3059, name: 'Lubao' },
            { id: 3060, name: 'Macabebe' },
            { id: 3061, name: 'Magalang' },
            { id: 3062, name: 'Minalin' },
            { id: 3063, name: 'Porac' },
            { id: 3064, name: 'San Luis' },
            { id: 3065, name: 'San Simon' },
            { id: 3066, name: 'Santa Ana' },
            { id: 3067, name: 'Santa Rita' },
            { id: 3068, name: 'Santa Teresita' },
            { id: 3069, name: 'Santo Tomas' }
        ],
        'Tarlac' : [
            { id: 3061, name: 'Tarlac City' },
            { id: 3062, name: 'Anao' },
            { id: 3063, name: 'Bamban' },
            { id: 3064, name: 'Concepcion' },
            { id: 3065, name: 'Gerona' },
            { id: 3066, name: 'La Paz' },
            { id: 3067, name: 'Mayantoc' },
            { id: 3068, name: 'Moncada' },
            { id: 3069, name: 'Paniqui' },
            { id: 3070, name: 'Pura' },
            { id: 3071, name: 'Ramos' },
            { id: 3072, name: 'San Clemente' },
            { id: 3073, name: 'San Jose' },
            { id: 3074, name: 'San Manuel' },
            { id: 3075, name: 'San Miguel' },
            { id: 3076, name: 'Santa Ignacia' },
            { id: 3077, name: 'Santa Lucia' },
            { id: 3078, name: 'Santa Rosa' },
            { id: 3079, name: 'Victoria' }
        ],
        'Zambales' : [
            { id: 3071, name: 'Olongapo City' },
            { id: 3072, name: 'Iba' },
            { id: 3073, name: 'Botolan' },
            { id: 3074, name: 'Candelaria' },
            { id: 3075, name: 'Castillejos' },
            { id: 3076, name: 'Masinloc' },
            { id: 3077, name: 'Palauig' },
            { id: 3078, name: 'San Antonio' },
            { id: 3079, name: 'San Felipe' },
            { id: 3080, name: 'San Marcelino' },
            { id: 3081, name: 'San Narciso' },
            { id: 3082, name: 'San Pablo' },
            { id: 3083, name: 'Santa Cruz' },
            { id: 3084, name: 'Santa Margarita' },
            { id: 3085, name: 'Santa Rita' }
        ],

        // Region IV-A - CALABARZON
'Region IV-A – CALABARZON' : [
    { id: 4011, name: 'Batangas City' },
    { id: 4012, name: 'Lipa City' },
    { id: 4013, name: 'Tanauan City' },
    { id: 4015, name: 'San Jose' },
    { id: 4016, name: 'Taal' },
    { id: 4017, name: 'Santa Teresita' },
    { id: 4018, name: 'San Juan' },
    { id: 4019, name: 'Cuenca' },
    { id: 4020, name: 'Ibaan' },
    { id: 4021, name: 'Laurel' },
    { id: 4022, name: 'Lemery' },
    { id: 4023, name: 'Mataasnakahoy' },
    { id: 4024, name: 'San Nicolas' },
    { id: 4025, name: 'San Pascual' },
    { id: 4026, name: 'Santa Teresa' }
],
'Batangas' : [
    { id: 4021, name: 'Agoncillo' },
    { id: 4022, name: 'Alitagtag' },
    { id: 4023, name: 'Balayan' },
    { id: 4024, name: 'Balete' },
    { id: 4025, name: 'Bauan' },
    { id: 4026, name: 'Calaca' },
    { id: 4027, name: 'Calatagan' },
    { id: 4028, name: 'Cuenca' },
    { id: 4029, name: 'Ibaan' },
    { id: 4030, name: 'Laurel' },
    { id: 4031, name: 'Lemery' },
    { id: 4032, name: 'Lian' },
    { id: 4033, name: 'Lobo' },
    { id: 4034, name: 'Mabini' },
    { id: 4035, name: 'Malvar' },
    { id: 4036, name: 'Mataasnakahoy' },
    { id: 4037, name: 'Nasugbu' },
    { id: 4038, name: 'Taal' }
],
'Cavite' : [
    { id: 4021, name: 'Cavite City' },
    { id: 4022, name: 'Tagaytay City' },
    { id: 4023, name: 'Dasmariñas City' },
    { id: 4024, name: 'Bacoor City' },
    { id: 4025, name: 'Imus City' },
    { id: 4026, name: 'Kawit' },
    { id: 4027, name: 'Noveleta' },
    { id: 4028, name: 'Rosario' },
    { id: 4029, name: 'General Trias' },
    { id: 4030, name: 'Tanza' },
    { id: 4031, name: 'Naic' },
    { id: 4032, name: 'Magallanes' },
    { id: 4033, name: 'Maragondon' },
    { id: 4034, name: 'Mendez' },
    { id: 4035, name: 'Silang' },
    { id: 4036, name: 'Alfonso' },
    { id: 4037, name: 'Amadeo' },
    { id: 4038, name: 'General Emilio Aguinaldo' }
],
'Laguna' : [
    { id: 4031, name: 'San Pablo City' },
    { id: 4032, name: 'Santa Rosa City' },
    { id: 4033, name: 'Calamba City' },
    { id: 4034, name: 'San Pedro' },
    { id: 4035, name: 'Binan' },
    { id: 4036, name: 'Laguna' },
    { id: 4037, name: 'Alaminos' },
    { id: 4038, name: 'Bay' },
    { id: 4039, name: 'Calauan' },
    { id: 4040, name: 'Cabuyao' },
    { id: 4041, name: 'Famy' },
    { id: 4042, name: 'Kawit' },
    { id: 4043, name: 'Lumban' },
    { id: 4044, name: 'Mabitac' },
    { id: 4045, name: 'Magdalena' },
    { id: 4046, name: 'Majayjay' },
    { id: 4047, name: 'Nagcarlan' },
    { id: 4048, name: 'Pagsanjan' },
    { id: 4049, name: 'Pangil' },
    { id: 4050, name: 'Rizal' },
    { id: 4051, name: 'San Antonio' },
    { id: 4052, name: 'San Juan' },
    { id: 4053, name: 'Santa Cruz' },
    { id: 4054, name: 'Santa Maria' }
],
'Quezon' : [
    { id: 4041, name: 'Lucena City' },
    { id: 4042, name: 'Tagkawayan' },
    { id: 4043, name: 'Tayabas City' },
    { id: 4044, name: 'Mauban' },
    { id: 4045, name: 'Sariaya' },
    { id: 4046, name: 'Candelaria' },
    { id: 4047, name: 'Guinayangan' },
    { id: 4048, name: 'Lucban' },
    { id: 4049, name: 'Pagbilao' },
    { id: 4050, name: 'Alabat' },
    { id: 4051, name: 'Bondoc' },
    { id: 4052, name: 'Calauag' },
    { id: 4053, name: 'Calauag' },
    { id: 4054, name: 'Dolores' },
    { id: 4055, name: 'General Luna' },
    { id: 4056, name: 'Lopez' },
    { id: 4057, name: 'Mulanay' },
    { id: 4058, name: 'Pitogo' },
    { id: 4059, name: 'Quezon' }
],
'Rizal' : [
    { id: 4051, name: 'Antipolo City' },
    { id: 4052, name: 'Binangonan' },
    { id: 4053, name: 'Cainta' },
    { id: 4054, name: 'Cardona' },
    { id: 4055, name: 'Jala-Jala' },
    { id: 4056, name: 'Rodriguez' },
    { id: 4057, name: 'San Mateo' },
    { id: 4058, name: 'Taytay' },
    { id: 4059, name: 'Angono' }
],

// Region IV-B - MIMAROPA
'Marinduque' : [
    { id: 5011, name: 'Boac' },
    { id: 5012, name: 'Mogpog' },
    { id: 5013, name: 'Santa Cruz' },
    { id: 5014, name: 'Santa Maria' },
    { id: 5015, name: 'Torrijos' }
],
'Occidental Mindoro' : [
    { id: 5021, name: 'San Jose' },
    { id: 5022, name: 'Mamburao' },
    { id: 5023, name: 'Paluan' },
    { id: 5024, name: 'Rizal' },
    { id: 5025, name: 'Sablayan' },
    { id: 5026, name: 'Occidental Mindoro' }
],
'Oriental Mindoro' : [
    { id: 5031, name: 'Calapan City' },
    { id: 5032, name: 'Puerto Galera' },
    { id: 5033, name: 'Baco' },
    { id: 5034, name: 'Bansud' },
    { id: 5035, name: 'Bongabong' },
    { id: 5036, name: 'Bulalacao' },
    { id: 5037, name: 'Gloria' },
    { id: 5038, name: 'Mansalay' },
    { id: 5039, name: 'Naujan' },
    { id: 5040, name: 'Pola' },
    { id: 5041, name: 'Roxas' },
    { id: 5042, name: 'San Teodoro' },
    { id: 5043, name: 'Victoria' }
],
'Palawan' : [
    { id: 5041, name: 'Puerto Princesa City' },
    { id: 5042, name: 'Cuyo' },
    { id: 5043, name: 'El Nido' },
    { id: 5044, name: 'Coron' },
    { id: 5045, name: 'Dumaran' },
    { id: 5046, name: 'Rizal' },
    { id: 5047, name: 'San Vicente' },
    { id: 5048, name: 'Sofronio Española' },
    { id: 5049, name: 'Taytay' }
],
'Romblon' : [
    { id: 5051, name: 'Romblon' },
    { id: 5052, name: 'Odiongan' },
    { id: 5053, name: 'Alcantara' },
    { id: 5054, name: 'Banton' },
    { id: 5055, name: 'Corcuera' },
    { id: 5056, name: 'Concepcion' },
    { id: 5057, name: 'Ferrol' },
    { id: 5058, name: 'Looc' },
    { id: 5059, name: 'San Agustin' },
    { id: 5060, name: 'San Andres' },
    { id: 5061, name: 'San Fernando' },
    { id: 5062, name: 'San Jose' },
    { id: 5063, name: 'San Roque' },
    { id: 5064, name: 'Santa Fe' },
    { id: 5065, name: 'Santa Maria' },
    { id: 5066, name: 'Tanduyan' }
],

        // Region V - Bicol Region
'Albay' : [
    { id: 6011, name: 'Legazpi City' },
    { id: 6012, name: 'Tabaco City' },
    { id: 6013, name: 'Ligao City' },
    { id: 6014, name: 'Camalig' },
    { id: 6015, name: 'Guinobatan' },
    { id: 6016, name: 'Jovellar' },
    { id: 6017, name: 'Libon' },
    { id: 6018, name: 'Malilipot' },
    { id: 6019, name: 'Manito' },
    { id: 6020, name: 'Oas' },
    { id: 6021, name: 'Pio Duran' },
    { id: 6022, name: 'Polangui' },
    { id: 6023, name: 'Rapu-Rapu' },
    { id: 6024, name: 'Santo Domingo' },
    { id: 6025, name: 'Tigaon' },
    { id: 6026, name: 'Viga' },
    { id: 6027, name: 'Vinzons' }
],
'Camarines Norte': [
    { id: 6021, name: 'Daet' },
    { id: 6022, name: 'Mercedes' },
    { id: 6023, name: 'Paracale' },
    { id: 6024, name: 'Jose Panganiban' },
    { id: 6025, name: 'Labo' },
    { id: 6026, name: 'Basud' },
    { id: 6027, name: 'Talisay' },
    { id: 6028, name: 'Capalonga' },
    { id: 6029, name: 'San Vicente' },
    { id: 6030, name: 'San Lorenzo Ruiz' }
],
'Camarines Sur': [
    { id: 6031, name: 'Naga City' },
    { id: 6032, name: 'Iriga City' },
    { id: 6033, name: 'Baao' },
    { id: 6034, name: 'Bato' },
    { id: 6035, name: 'Buhi' },
    { id: 6036, name: 'Bula' },
    { id: 6037, name: 'Calabanga' },
    { id: 6038, name: 'Canaman' },
    { id: 6039, name: 'Caramoan' },
    { id: 6040, name: 'Del Gallego' },
    { id: 6041, name: 'Gainza' },
    { id: 6042, name: 'Lupi' },
    { id: 6043, name: 'Magarao' },
    { id: 6044, name: 'Minalabac' },
    { id: 6045, name: 'Nabua' },
    { id: 6046, name: 'Pamplona' },
    { id: 6047, name: 'Pasacao' },
    { id: 6048, name: 'Pili' },
    { id: 6049, name: 'Ragay' },
    { id: 6050, name: 'Sipocot' },
    { id: 6051, name: 'Tigaon' }
],
'Catanduanes': [
    { id: 6041, name: 'Virac' },
    { id: 6042, name: 'Bato' },
    { id: 6043, name: 'San Andres' },
    { id: 6044, name: 'San Miguel' },
    { id: 6045, name: 'Caramoran' },
    { id: 6046, name: 'Panganiban' },
    { id: 6047, name: 'Bagamanoc' },
    { id: 6048, name: 'Viga' },
    { id: 6049, name: 'Payo' },
    { id: 6050, name: 'Pangyunang' }
],
'Masbate': [
    { id: 6051, name: 'Masbate City' },
    { id: 6052, name: 'Mobo' },
    { id: 6053, name: 'Uson' },
    { id: 6054, name: 'Baleno' },
    { id: 6055, name: 'Balud' },
    { id: 6056, name: 'Batuan' },
    { id: 6057, name: 'Cataingan' },
    { id: 6058, name: 'Cawayan' },
    { id: 6059, name: 'Dimasalang' },
    { id: 6060, name: 'Milagros' },
    { id: 6061, name: 'Palanas' },
    { id: 6062, name: 'Placer' },
    { id: 6063, name: 'San Fernando' },
    { id: 6064, name: 'San Jacinto' },
    { id: 6065, name: 'San Pascual' },
    { id: 6066, name: 'San Agustin' },
    { id: 6067, name: 'San Antonio' },
    { id: 6068, name: 'San Pedro' },
    { id: 6069, name: 'Ticao Island' }
],
'Sorsogon': [
    { id: 6061, name: 'Sorsogon City' },
    { id: 6062, name: 'Bulusan' },
    { id: 6063, name: 'Casiguran' },
    { id: 6064, name: 'Donsol' },
    { id: 6065, name: 'Gubat' },
    { id: 6066, name: 'Irosin' },
    { id: 6067, name: 'Magallanes' },
    { id: 6068, name: 'Pto. Díaz' },
    { id: 6069, name: 'Sorsogon' },
    { id: 6070, name: 'Sta. Magdalena' }
],

// Region VI - Western Visayas
'Aklan': [
    { id: 7011, name: 'Kalibo' },
    { id: 7012, name: 'Altavas' },
    { id: 7013, name: 'Banga' },
    { id: 7014, name: 'Batan' },
    { id: 7015, name: 'Buruanga' },
    { id: 7016, name: 'Ibajay' },
    { id: 7017, name: 'Kalamansig' },
    { id: 7018, name: 'Libacao' },
    { id: 7019, name: 'Malay' },
    { id: 7020, name: 'New Washington' },
    { id: 7021, name: 'Numancia' },
    { id: 7022, name: 'Tangalan' }
],
'Antique': [
    { id: 7021, name: 'San Jose de Buenavista' },
    { id: 7022, name: 'Hamtic' },
    { id: 7023, name: 'Sibalom' },
    { id: 7024, name: 'Bugasong' },
    { id: 7025, name: 'Patnongon' },
    { id: 7026, name: 'Valderrama' },
    { id: 7027, name: 'San Remigio' },
    { id: 7028, name: 'Culasi' },
    { id: 7029, name: 'Pandan' },
    { id: 7030, name: 'Sebaste' },
    { id: 7031, name: 'Tibiao' }
],
'Capiz': [
    { id: 7031, name: 'Roxas City' },
    { id: 7032, name: 'Ivisan' },
    { id: 7033, name: 'Panay' },
    { id: 7034, name: 'Maayon' },
    { id: 7035, name: 'Sigma' },
    { id: 7036, name: 'Pilar' },
    { id: 7037, name: 'Mambusao' },
    { id: 7038, name: 'Dao' },
    { id: 7039, name: 'Sapian' },
    { id: 7040, name: 'Panitan' },
    { id: 7041, name: 'Talingting' }
],
'Guimaras': [
    { id: 7041, name: 'Jordan' },
    { id: 7042, name: 'Buenavista' },
    { id: 7043, name: 'San Lorenzo' },
    { id: 7044, name: 'San Miguel' }
],
'Iloilo': [
    { id: 7051, name: 'Iloilo City' },
    { id: 7052, name: 'Passi City' },
    { id: 7053, name: 'Barotac Nuevo' },
    { id: 7054, name: 'Janiuay' },
    { id: 7055, name: 'Oton' },
    { id: 7056, name: 'Leganes' },
    { id: 7057, name: 'Pavia' },
    { id: 7058, name: 'San Miguel' },
    { id: 7059, name: 'San Rafael' },
    { id: 7060, name: 'Santa Barbara' },
    { id: 7061, name: 'Dingle' },
    { id: 7062, name: 'San Dionisio' },
    { id: 7063, name: 'Sara' },
    { id: 7064, name: 'Maasin' }
],
'Negros Occidental': [
    { id: 7061, name: 'Bacolod City' },
    { id: 7062, name: 'Bago City' },
    { id: 7063, name: 'Cadiz City' },
    { id: 7064, name: 'Escalante City' },
    { id: 7065, name: 'Himamaylan City' },
    { id: 7066, name: 'Kabankalan City' },
    { id: 7067, name: 'La Carlota City' },
    { id: 7068, name: 'Sagay City' },
    { id: 7069, name: 'San Carlos City' },
    { id: 7070, name: 'Silay City' },
    { id: 7071, name: 'Talisay City' },
    { id: 7072, name: 'Victorias City' }
],

        // Region VII - Central Visayas
'Bohol': [
    { id: 8011, name: 'Tagbilaran City' },
    { id: 8012, name: 'Danao City' },
    { id: 8013, name: 'Anda' },
    { id: 8014, name: 'Loon' },
    { id: 8015, name: 'Panglao' }
],
'Cebu': [
    { id: 8021, name: 'Cebu City' },
    { id: 8022, name: 'Lapu-Lapu City' },
    { id: 8023, name: 'Mandaue City' },
    { id: 8024, name: 'Carcar City' },
    { id: 8025, name: 'Bogo City' }
],
'Negros Oriental': [
    { id: 8031, name: 'Dumaguete City' },
    { id: 8032, name: 'Bais City' },
    { id: 8033, name: 'Bayawan City' },
    { id: 8034, name: 'Tanjay City' }
],
'Siquijor': [
    { id: 8041, name: 'Siquijor' },
    { id: 8042, name: 'Larena' },
    { id: 8043, name: 'San Juan' },
    { id: 8044, name: 'Lazi' },
    { id: 8045, name: 'Siquijor' }
],

// Region VIII - Eastern Visayas
'Biliran': [
    { id: 9011, name: 'Naval' },
    { id: 9012, name: 'Biliran' },
    { id: 9013, name: 'Kawayan' },
    { id: 9014, name: 'Maripipi' },
    { id: 9015, name: 'Caibiran' }
],
'Eastern Samar': [
    { id: 9021, name: 'Borongan City' },
    { id: 9022, name: 'Guiuan' },
    { id: 9023, name: 'Balayni' },
    { id: 9024, name: 'Maydolong' },
    { id: 9025, name: 'Salcedo' }
],
'Leyte': [
    { id: 9031, name: 'Tacloban City' },
    { id: 9032, name: 'Ormoc City' },
    { id: 9033, name: 'Baybay City' },
    { id: 9034, name: 'Carigara' },
    { id: 9035, name: 'Tanauan' }
],
'Northern Samar': [
    { id: 9041, name: 'Catarman' },
    { id: 9042, name: 'Sorsogon' },
    { id: 9043, name: 'Bobon' },
    { id: 9044, name: 'Laoang' },
    { id: 9045, name: 'Gamay' }
],
'Samar (Western Samar)': [
    { id: 9051, name: 'Calbayog City' },
    { id: 9052, name: 'Catbalogan City' },
    { id: 9053, name: 'Basey' },
    { id: 9054, name: 'Calbiga' },
    { id: 9055, name: 'Marabut' }
],
'Southern Leyte': [
    { id: 9061, name: 'Maasin City' },
    { id: 9062, name: 'Sogod' },
    { id: 9063, name: 'Libagon' },
    { id: 9064, name: 'San Juan' },
    { id: 9065, name: 'Saint Bernard' }
],

        // Region IX - Zamboanga Peninsula
'Zamboanga del Norte': [
    { id: 10011, name: 'Dipolog City' },
    { id: 10012, name: 'Dapitan City' },
    { id: 10013, name: 'Polanco' },
    { id: 10014, name: 'Sergio Osmeña Sr.' },
    { id: 10015, name: 'Salug' }
],
'Zamboanga del Sur': [
    { id: 10021, name: 'Pagadian City' },
    { id: 10022, name: 'Molave' },
    { id: 10023, name: 'Alicia' },
    { id: 10024, name: 'Guipos' }
],
'Zamboanga Sibugay': [
  { id: 10031, name: 'Ipil' },
  { id: 10032, name: 'Alicia' },
  { id: 10033, name: 'Buug' },
  { id: 10034, name: 'Diplahan' },
  { id: 10035, name: 'Imelda' },
  { id: 10036, name: 'Kabasalan' },
  { id: 10037, name: 'Mabuhay' },
  { id: 10038, name: 'Malangas' },
  { id: 10039, name: 'Naga' },
  { id: 10040, name: 'Olutanga' },
  { id: 10041, name: 'Payao' },
  { id: 10042, name: 'Roseller T. Lim' },
  { id: 10043, name: 'Siay' },
  { id: 10044, name: 'Talusan' },
  { id: 10045, name: 'Titay' },
  { id: 10046, name: 'Tungawan' }  
],

// Region X - Northern Mindanao
'Bukidnon': [
    { id: 11011, name: 'Malaybalay City' },
    { id: 11012, name: 'Valencia City' },
    { id: 11013, name: 'Maramag' },
    { id: 11014, name: 'Manolo Fortich' },
    { id: 11015, name: 'Cabanglasan' }
],
'Camiguin': [
    { id: 11021, name: 'Mambajao' },
    { id: 11022, name: 'Catarman' },
    { id: 11023, name: 'Guinsiliban' },
    { id: 11024, name: 'Sagay' },
    { id: 11025, name: 'Mahinog' }
],
'Lanao del Norte': [
    { id: 11031, name: 'Iligan City' },
    { id: 11032, name: 'Tangub City' },
    { id: 11033, name: 'Kapatagan' },
    { id: 11034, name: 'Kauswagan' },
    { id: 11035, name: 'Linamon' }
],
'Misamis Occidental': [
    { id: 11041, name: 'Oroquieta City' },
    { id: 11042, name: 'Ozamiz City' },
    { id: 11043, name: 'Tudela' },
    { id: 11044, name: 'Jimenez' },
    { id: 11045, name: 'Plaridel' }
],
'Misamis Oriental': [
    { id: 11051, name: 'Cagayan de Oro City' },
    { id: 11052, name: 'Gingoog City' },
    { id: 11053, name: 'Jasaan' },
    { id: 11054, name: 'Gitagum' },
    { id: 11055, name: 'Villanueva' }
],


        // Region XI - Davao Region
'Davao de Oro': [
    { id: 12011, name: 'Monkayo' },
    { id: 12012, name: 'Nabunturan' },
    { id: 12013, name: 'Pantukan' },
    { id: 12014, name: 'New Bataan' },
    { id: 12015, name: 'Maragusan' }
],
'Davao del Norte': [
    { id: 12021, name: 'Tagum City' },
    { id: 12022, name: 'Panabo City' },
    { id: 12023, name: 'Island Garden City of Samal' },
    { id: 12024, name: 'Kapalong' },
    { id: 12025, name: 'Asuncion' }
],
'Davao del Sur': [
    { id: 12031, name: 'Digos City' },
    { id: 12032, name: 'Bansalan' },
    { id: 12033, name: 'Hagonoy' },
    { id: 12034, name: 'Kiblawan' },
    { id: 12035, name: 'Magsaysay' },
    { id: 12036, name: 'Malalag' },
    { id: 12037, name: 'Matanao' },
    { id: 12038, name: 'Padada' },
    { id: 12039, name: 'Santa Cruz' },
    { id: 12040, name: 'Sulop' }
],

'Davao Occidental': [
    { id: 12041, name: 'Malita' },
    { id: 12042, name: 'Santa Maria' },
    { id: 12043, name: 'Don Marcelino' },
    { id: 12044, name: 'Jose Abad Santos' }
],
'Davao Oriental': [
    { id: 12051, name: 'Mati City' },
    { id: 12052, name: 'Baganga' },
    { id: 12053, name: 'Cateel' },
    { id: 12054, name: 'Boston' },
    { id: 12055, name: 'Governor Generoso' }
],

// Region XII - SOCCSKSARGEN
'North Cotabato': [
    { id: 13011, name: 'Kidapawan City' },
    { id: 13012, name: 'Midsayap' },
    { id: 13013, name: 'Matalam' },
    { id: 13014, name: 'Pikit' },
    { id: 13015, name: 'Kabacan' }
],
'Sarangani': [
    { id: 13021, name: 'Alabel' },
    { id: 13022, name: 'Malungon' },
    { id: 13023, name: 'Kiamba' },
    { id: 13024, name: 'Maasim' },
    { id: 13025, name: 'Glan' }
],
'South Cotabato': [
    { id: 13031, name: 'General Santos City' },
    { id: 13032, name: 'Koronadal City' },
    { id: 13033, name: 'Surallah' },
    { id: 13034, name: 'Tupi' },
    { id: 13035, name: 'Banga' }
],
'Sultan Kudarat': [
    { id: 13041, name: 'Tacurong City' },
    { id: 13042, name: 'Isulan' },
    { id: 13043, name: 'Lambayong' },
    { id: 13044, name: 'Sen. Ninoy Aquino' },
    { id: 13045, name: 'Palimbang' }
],


// Region XIII - Caraga
'Agusan del Norte': [
    { id: 14011, name: 'Butuan City' },
    { id: 14012, name: 'Cabadbaran City' }
],
'Agusan del Sur': [
    { id: 14021, name: 'Bayugan City' }
],
'Surigao del Norte': [
    { id: 14031, name: 'Surigao City' },
    { id: 14032, name: 'Del Carmen' },
    { id: 14033, name: 'Sison' },
    { id: 14034, name: 'Claver' }
],
'Surigao del Sur': [
    { id: 14041, name: 'Tandag City' },
    { id: 14042, name: 'Bislig City' },
    { id: 14043, name: 'Carrascal' },
    { id: 14044, name: 'Madrid' }
],
'Dinagat Islands': [
    { id: 14051, name: 'Dinagat' },
    { id: 14052, name: 'Cagdianao' },
    { id: 14053, name: 'Basilisa' },
    { id: 14054, name: 'San Jose' }
],

// NCR - National Capital Region
'Metro Manila': [
    { id: 15011, name: 'Manila' },
    { id: 15012, name: 'Quezon City' },
    { id: 15013, name: 'Makati City' },
    { id: 15014, name: 'Pasig City' },
    { id: 15015, name: 'Caloocan City' },
    { id: 15016, name: 'Taguig City' },
    { id: 15017, name: 'Las Piñas City' },
    { id: 15018, name: 'Mandaluyong City' },
    { id: 15019, name: 'Marikina City' },
    { id: 15020, name: 'Pasay City' },
    { id: 15021, name: 'San Juan City' },
    { id: 15022, name: 'Valenzuela City' },
    { id: 15023, name: 'Muntinlupa City' }
],


        // CAR - Cordillera Administrative Region
'Abra': [
    { id: 16011, name: 'Bangued' },
    { id: 16012, name: 'Lagayan' },
    { id: 16013, name: 'Luba' }
],
'Apayao': [
    { id: 16021, name: 'Kabugao' },
    { id: 16022, name: 'Conner' },
    { id: 16023, name: 'Calanasan' }
],
'Benguet': [
    { id: 16031, name: 'La Trinidad' },
    { id: 16032, name: 'Baguio City' },
    { id: 16033, name: 'Itogon' }
],
'Ifugao': [
    { id: 16041, name: 'Lagawe' },
    { id: 16042, name: 'Natonin' },
    { id: 16043, name: 'Lamut' }
],
'Kalinga': [
    { id: 16051, name: 'Tabuk City' },
    { id: 16052, name: 'Pasil' },
    { id: 16053, name: 'Rizal' }
],
'Mountain Province': [
    { id: 16061, name: 'Bontoc' },
    { id: 16062, name: 'Sagada' },
    { id: 16063, name: 'Sabangan' }
],

// BARMM - Bangsamoro Autonomous Region in Muslim Mindanao
'Basilan': [
    { id: 17011, name: 'Isabela City' },
    { id: 17012, name: 'Lamitan City' },
    { id: 17013, name: 'Maluso' }
],
'Lanao del Sur': [
    { id: 17021, name: 'Marawi City' },
    { id: 17022, name: 'Balindong' },
    { id: 17023, name: 'Magsaysay' }
],
'Maguindanao': [
    { id: 17031, name: 'Cotabato City' },
    { id: 17032, name: 'Shariff Aguak' },
    { id: 17033, name: 'Datu Odin Sinsuat' }
],
'Sulu': [
    { id: 17041, name: 'Jolo' },
    { id: 17042, name: 'Indanan' },
    { id: 17043, name: 'Patikul' }
],
'Tawi-Tawi': [
    { id: 17051, name: 'Bongao' },
    { id: 17052, name: 'Sapa-Sapa' },
    { id: 17053, name: 'Mapun' }
],

 };


 let citySelect = document.getElementById('city');
 let provinceName = document.getElementById('province').value;

 citySelect.innerHTML = '<option value="">Select City / Municipality</option>';  // Reset options
 if (provinceName && cities[provinceName]) {
     cities[provinceName].forEach(city => {
         let option = document.createElement('option');
         option.value = city.name;  // Set value to the city name
         option.text = city.name;
         citySelect.appendChild(option);
     });
    }
}

function loadBarangays() {
    const barangays = {
        'Laoag City': [
            { id: 1011, name: 'Barangay 1 (Calabaza)' },
            { id: 182, name: 'Barangay 2 (San Juan)' },
            { id: 183, name: 'Barangay 3 (San Pedro)' },
            { id: 184, name: 'Barangay 4 (San Roque)' },
            { id: 185, name: 'Barangay 5 (San Vicente)' },
            { id: 186, name: 'Barangay 6 (San Isidro)' },
            { id: 187, name: 'Barangay 7 (San Andres)' },
            { id: 188, name: 'Barangay 8 (San Antonio)' },
            { id: 189, name: 'Barangay 9 (San Nicolas)' },
            { id: 190, name: 'Barangay 10 (San Guillermo)' },
            { id: 191, name: 'Barangay 11 (San Rafael)' },
            { id: 192, name: 'Barangay 12 (San Jose)' },
            { id: 193, name: 'Barangay 13 (San Agustin)' },
            { id: 194, name: 'Barangay 14 (San Esteban)' },
            { id: 195, name: 'Barangay 15 (San Bartolome)' },
            { id: 196, name: 'Barangay 16 (San Pedro)' },
            { id: 197, name: 'Barangay 17 (San Andres)' },
            { id: 198, name: 'Barangay 18 (San Martin)' },
            { id: 199, name: 'Barangay 19 (San Francisco)' },
            { id: 200, name: 'Barangay 20 (San Fernando)' }
        ],
        'Batac City': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (Poblacion)' },
            { id: 1017, name: 'Brgy. 7 (Poblacion)' },
            { id: 1018, name: 'Brgy. 8 (Poblacion)' },
            { id: 1019, name: 'Brgy. 9 (Poblacion)' },
            { id: 1020, name: 'Brgy. 10 (Poblacion)' },
            { id: 1021, name: 'Brgy. Aglipay' },
            { id: 1022, name: 'Brgy. Anocao' },
            { id: 1023, name: 'Brgy. Baloctaoc' },
            { id: 1024, name: 'Brgy. Barit' },
            { id: 1025, name: 'Brgy. Bato' },
            { id: 1026, name: 'Brgy. Biligan' },
            { id: 1027, name: 'Brgy. Bulala' },
            { id: 1028, name: 'Brgy. Calabaza' },
            { id: 1029, name: 'Brgy. San Pedro' },
            { id: 1030, name: 'Brgy. San Jose' },
            { id: 1031, name: 'Brgy. San Vicente' },
            { id: 1032, name: 'Brgy. San Pablo' },
            { id: 1033, name: 'Brgy. San Isidro' },
            { id: 1034, name: 'Brgy. San Roque' },
            { id: 1035, name: 'Brgy. Sta. Ana' }
        ],
        'Adams': [
            { id: 1011, name: 'Brgy. Adams' },
            { id: 1012, name: 'Brgy. Asipulo' },
            { id: 1013, name: 'Brgy. Cabaroan' },
            { id: 1014, name: 'Brgy. Dalit' },
            { id: 1015, name: 'Brgy. Duldulao' },
            { id: 1016, name: 'Brgy. Limmok' },
            { id: 1017, name: 'Brgy. Magtang' },
            { id: 1018, name: 'Brgy. Nangalisan' },
            { id: 1019, name: 'Brgy. Pao' },
            { id: 1020, name: 'Brgy. Quiling' }
        ],
        'Bacarra': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Pedro)' },
            { id: 1017, name: 'Brgy. 7 (San Juan)' },
            { id: 1018, name: 'Brgy. 8 (San Mateo)' },
            { id: 1019, name: 'Brgy. 9 (San Antonio)' },
            { id: 1020, name: 'Brgy. 10 (San Pablo)' }
        ],
        'Badoc': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Francisco)' },
            { id: 1017, name: 'Brgy. 7 (San Vicente)' },
            { id: 1018, name: 'Brgy. 8 (San Isidro)' },
            { id: 1019, name: 'Brgy. 9 (San Roque)' },
            { id: 1020, name: 'Brgy. 10 (San Jose)' }
        ],
        'Bangui': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Juan)' },
            { id: 1017, name: 'Brgy. 7 (San Roque)' },
            { id: 1018, name: 'Brgy. 8 (San Pedro)' },
            { id: 1019, name: 'Brgy. 9 (San Vicente)' },
            { id: 1020, name: 'Brgy. 10 (San Jose)' }
        ],
        'Banna': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Isidro)' },
            { id: 1017, name: 'Brgy. 7 (San Vicente)' },
            { id: 1018, name: 'Brgy. 8 (San Roque)' },
            { id: 1019, name: 'Brgy. 9 (San Pedro)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],        
        'Burgos': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Isidro)' },
            { id: 1017, name: 'Brgy. 7 (San Pedro)' },
            { id: 1018, name: 'Brgy. 8 (San Roque)' },
            { id: 1019, name: 'Brgy. 9 (San Vicente)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Carasi': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Isidro)' },
            { id: 1017, name: 'Brgy. 7 (San Juan)' },
            { id: 1018, name: 'Brgy. 8 (San Pedro)' },
            { id: 1019, name: 'Brgy. 9 (San Roque)' },
            { id: 1020, name: 'Brgy. 10 (San Vicente)' }
        ],   
        'Currimao': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Isidro)' },
            { id: 1017, name: 'Brgy. 7 (San Pedro)' },
            { id: 1018, name: 'Brgy. 8 (San Vicente)' },
            { id: 1019, name: 'Brgy. 9 (San Roque)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Dingras': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Pedro)' },
            { id: 1017, name: 'Brgy. 7 (San Vicente)' },
            { id: 1018, name: 'Brgy. 8 (San Isidro)' },
            { id: 1019, name: 'Brgy. 9 (San Roque)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Dumalneg': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Vicente)' },
            { id: 1017, name: 'Brgy. 7 (San Roque)' },
            { id: 1018, name: 'Brgy. 8 (San Pedro)' },
            { id: 1019, name: 'Brgy. 9 (San Isidro)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Marcos': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Vicente)' },
            { id: 1017, name: 'Brgy. 7 (San Pedro)' },
            { id: 1018, name: 'Brgy. 8 (San Roque)' },
            { id: 1019, name: 'Brgy. 9 (San Isidro)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Nueva Era': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Pedro)' },
            { id: 1017, name: 'Brgy. 7 (San Vicente)' },
            { id: 1018, name: 'Brgy. 8 (San Isidro)' },
            { id: 1019, name: 'Brgy. 9 (San Roque)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Pagudpud': [
            { id: 1011, name: 'Brgy. 1 (Poblacion)' },
            { id: 1012, name: 'Brgy. 2 (Poblacion)' },
            { id: 1013, name: 'Brgy. 3 (Poblacion)' },
            { id: 1014, name: 'Brgy. 4 (Poblacion)' },
            { id: 1015, name: 'Brgy. 5 (Poblacion)' },
            { id: 1016, name: 'Brgy. 6 (San Pedro)' },
            { id: 1017, name: 'Brgy. 7 (San Vicente)' },
            { id: 1018, name: 'Brgy. 8 (San Isidro)' },
            { id: 1019, name: 'Brgy. 9 (San Roque)' },
            { id: 1020, name: 'Brgy. 10 (San Juan)' }
        ],
        'Paoay': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Pedro)" },
                { "id": 1017, "name": "Brgy. 7 (San Vicente)" },
                { "id": 1018, "name": "Brgy. 8 (San Isidro)" },
                { "id": 1019, "name": "Brgy. 9 (San Roque)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Pasuquin': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Pedro)" },
                { "id": 1017, "name": "Brgy. 7 (San Vicente)" },
                { "id": 1018, "name": "Brgy. 8 (San Isidro)" },
                { "id": 1019, "name": "Brgy. 9 (San Roque)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Piddig': [
                { "id": 1011, "name": "Brgy. Aglipay" },
                { "id": 1012, "name": "Brgy. Bagumbayan" },
                { "id": 1013, "name": "Brgy. Barit" },
                { "id": 1014, "name": "Brgy. Bato" },
                { "id": 1015, "name": "Brgy. Biligan" },
                { "id": 1016, "name": "Brgy. Carinup" },
                { "id": 1017, "name": "Brgy. Cato" },
                { "id": 1018, "name": "Brgy. Catuguing" },
                { "id": 1019, "name": "Brgy. Dumay" },
                { "id": 1020, "name": "Brgy. Guinnisilib" },
                { "id": 1021, "name": "Brgy. Mabuti" },
                { "id": 1022, "name": "Brgy. Masipag" },
                { "id": 1023, "name": "Brgy. Nagsurot" },
                { "id": 1024, "name": "Brgy. Nagbalayong" },
                { "id": 1025, "name": "Brgy. Palpalok" },
                { "id": 1026, "name": "Brgy. Pasuquin" },
                { "id": 1027, "name": "Brgy. Piddig" },
                { "id": 1028, "name": "Brgy. San Andres" },
                { "id": 1029, "name": "Brgy. San Agustin" },
                { "id": 1030, "name": "Brgy. San Isidro" },
                { "id": 1031, "name": "Brgy. San Juan" },
                { "id": 1032, "name": "Brgy. San Miguel" },
                { "id": 1033, "name": "Brgy. San Pedro" },
                { "id": 1034, "name": "Brgy. San Roque" },
                { "id": 1035, "name": "Brgy. San Vicente" }
            ],
            'Pinili': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Pedro)" },
                { "id": 1017, "name": "Brgy. 7 (San Vicente)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Santa Ana': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Santa Catalina': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Santa Cruz': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Santa Maria': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Sarrat': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Solsona': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Vintar': [
                { "id": 1011, "name": "Brgy. 1 (Poblacion)" },
                { "id": 1012, "name": "Brgy. 2 (Poblacion)" },
                { "id": 1013, "name": "Brgy. 3 (Poblacion)" },
                { "id": 1014, "name": "Brgy. 4 (Poblacion)" },
                { "id": 1015, "name": "Brgy. 5 (Poblacion)" },
                { "id": 1016, "name": "Brgy. 6 (San Vicente)" },
                { "id": 1017, "name": "Brgy. 7 (San Pedro)" },
                { "id": 1018, "name": "Brgy. 8 (San Roque)" },
                { "id": 1019, "name": "Brgy. 9 (San Isidro)" },
                { "id": 1020, "name": "Brgy. 10 (San Juan)" }
            ],
            'Vigan City': [
    { "id": 1021, "name": "Ayusan Norte" },
    { "id": 1022, "name": "Ayusan Sur" },
    { "id": 1023, "name": "Barangay I (Poblacion)" },
    { "id": 1024, "name": "Barangay II (Poblacion)" },
    { "id": 1025, "name": "Barangay III (Poblacion)" },
    { "id": 1026, "name": "Barangay IV (Poblacion)" },
    { "id": 1027, "name": "Barangay V (Poblacion)" },
    { "id": 1028, "name": "Barangay VI (Poblacion)" },
    { "id": 1029, "name": "Barangay VII (Poblacion)" },
    { "id": 1030, "name": "Barangay VIII (Poblacion)" },
    { "id": 1031, "name": "Barangay IX (Poblacion)" },
    { "id": 1032, "name": "Barangay X (Poblacion)" },
    { "id": 1033, "name": "Barangay XI (Poblacion)" },
    { "id": 1034, "name": "Barangay XII (Poblacion)" },
    { "id": 1035, "name": "Beddeng Daya" },
    { "id": 1036, "name": "Beddeng Laud" },
    { "id": 1037, "name": "Bongtolan" },
    { "id": 1038, "name": "Bulala" },
    { "id": 1039, "name": "Cabalangegan" },
    { "id": 1040, "name": "Cabaroan Daya" },
    { "id": 1041, "name": "Cabaroan Laud" },
    { "id": 1042, "name": "Camangaan" },
    { "id": 1043, "name": "Capangpangan" },
    { "id": 1044, "name": "Mindoro" },
    { "id": 1045, "name": "Nagsangalan" },
    { "id": 1046, "name": "Pantay Daya" },
    { "id": 1047, "name": "Pantay Fatima" },
    { "id": 1048, "name": "Pantay Laud" },
    { "id": 1049, "name": "Paoa" },
    { "id": 1050, "name": "Pong-ol" },
    { "id": 1051, "name": "Raois" },
    { "id": 1052, "name": "Rizal" },
    { "id": 1053, "name": "Salindeg" },
    { "id": 1054, "name": "San Jose" },
    { "id": 1055, "name": "San Julian Norte" },
    { "id": 1056, "name": "San Julian Sur" },
    { "id": 1057, "name": "San Pedro" },
    { "id": 1058, "name": "Tamag" },
    { "id": 1059, "name": "Vigan Mindoro" }
],
'Candon City': [
    { "id": 1101, "name": "Allangigan Primero" },
    { "id": 1102, "name": "Allangigan Segundo" },
    { "id": 1103, "name": "Amguid" },
    { "id": 1104, "name": "Ayudante" },
    { "id": 1105, "name": "Bagani Camposanto" },
    { "id": 1106, "name": "Bagani Gabor" },
    { "id": 1107, "name": "Bagani Tocgo" },
    { "id": 1108, "name": "Bagani Ubbog" },
    { "id": 1109, "name": "Balingaoan" },
    { "id": 1110, "name": "Bitalag" },
    { "id": 1111, "name": "Bugnay" },
    { "id": 1112, "name": "Calaoa-an" },
    { "id": 1113, "name": "Calongbuyan" },
    { "id": 1114, "name": "Darapidap" },
    { "id": 1115, "name": "Langlangca Primero" },
    { "id": 1116, "name": "Langlangca Segundo" },
    { "id": 1117, "name": "Palacapac" },
    { "id": 1118, "name": "Paras" },
    { "id": 1119, "name": "Parioc Primero" },
    { "id": 1120, "name": "Parioc Segundo" },
    { "id": 1121, "name": "Patpata Primero" },
    { "id": 1122, "name": "Patpata Segundo" },
    { "id": 1123, "name": "Rabanes" },
    { "id": 1124, "name": "Salvador Primero" },
    { "id": 1125, "name": "Salvador Segundo" },
    { "id": 1126, "name": "San Agustin" },
    { "id": 1127, "name": "San Isidro" },
    { "id": 1128, "name": "San Nicolas" },
    { "id": 1129, "name": "San Pedro" },
    { "id": 1130, "name": "San Vicente" },
    { "id": 1131, "name": "Santo Tomas" },
    { "id": 1132, "name": "Tablac" },
    { "id": 1133, "name": "Talogtog" },
    { "id": 1134, "name": "Tamurong Primero" },
    { "id": 1135, "name": "Tamurong Segundo" },
    { "id": 1136, "name": "Virbira" },
    { "id": 1137, "name": "Lingsat" },
    { "id": 1138, "name": "Gallano" }
],
'Candon City': [
    { "id": 1101, "name": "Allangigan Primero" },
    { "id": 1102, "name": "Allangigan Segundo" },
    { "id": 1103, "name": "Amguid" },
    { "id": 1104, "name": "Ayudante" },
    { "id": 1105, "name": "Bagani Camposanto" },
    { "id": 1106, "name": "Bagani Gabor" },
    { "id": 1107, "name": "Bagani Tocgo" },
    { "id": 1108, "name": "Bagani Ubbog" },
    { "id": 1109, "name": "Balingaoan" },
    { "id": 1110, "name": "Bitalag" },
    { "id": 1111, "name": "Bugnay" },
    { "id": 1112, "name": "Calaoa-an" },
    { "id": 1113, "name": "Calongbuyan" },
    { "id": 1114, "name": "Darapidap" },
    { "id": 1115, "name": "Langlangca Primero" },
    { "id": 1116, "name": "Langlangca Segundo" },
    { "id": 1117, "name": "Palacapac" },
    { "id": 1118, "name": "Paras" },
    { "id": 1119, "name": "Parioc Primero" },
    { "id": 1120, "name": "Parioc Segundo" },
    { "id": 1121, "name": "Patpata Primero" },
    { "id": 1122, "name": "Patpata Segundo" },
    { "id": 1123, "name": "Rabanes" },
    { "id": 1124, "name": "Salvador Primero" },
    { "id": 1125, "name": "Salvador Segundo" },
    { "id": 1126, "name": "San Agustin" },
    { "id": 1127, "name": "San Isidro" },
    { "id": 1128, "name": "San Nicolas" },
    { "id": 1129, "name": "San Pedro" },
    { "id": 1130, "name": "San Vicente" },
    { "id": 1131, "name": "Santo Tomas" },
    { "id": 1132, "name": "Tablac" },
    { "id": 1133, "name": "Talogtog" },
    { "id": 1134, "name": "Tamurong Primero" },
    { "id": 1135, "name": "Tamurong Segundo" },
    { "id": 1136, "name": "Virbira" },
    { "id": 1137, "name": "Lingsat" },
    { "id": 1138, "name": "Gallano" }
],
'Cabugao':  [
    { "id": 1139, "name": "Pug-os" },
    { "id": 1140, "name": "Quezon" },
    { "id": 1141, "name": "Reppaac" },
    { "id": 1142, "name": "Rizal" },
    { "id": 1143, "name": "Sabang" },
    { "id": 1144, "name": "Sagayaden" },
    { "id": 1145, "name": "Salapasap" },
    { "id": 1146, "name": "Salomague" },
    { "id": 1147, "name": "Sisim" },
    { "id": 1148, "name": "Turod" },
    { "id": 1149, "name": "Turod-Patac" }
],
'Concordia': [
    { "id": 1150, "name": "Poblacion" },
    { "id": 1151, "name": "Caliat" },
    { "id": 1152, "name": "Malineng" },
    { "id": 1153, "name": "Sagat" },
    { "id": 1154, "name": "Baybay" },
    { "id": 1155, "name": "Calasipan" },
    { "id": 1156, "name": "Catongan" },
    { "id": 1157, "name": "Dapdappig" },
    { "id": 1158, "name": "Dulao" },
    { "id": 1159, "name": "Linga" },
    { "id": 1160, "name": "Nagpanao" },
    { "id": 1161, "name": "Pambuan" },
    { "id": 1162, "name": "Pug-os" },
    { "id": 1163, "name": "Rizal" },
    { "id": 1164, "name": "Sakil" },
    { "id": 1165, "name": "San Pedro" },
    { "id": 1166, "name": "San Rafael" }
],
'Galimuyod': [
    { "id": 1167, "name": "Bitong" },
    { "id": 1168, "name": "Calumbaya" },
    { "id": 1169, "name": "Nagsuputan" },
    { "id": 1170, "name": "Poblacion" },
    { "id": 1171, "name": "Rizal" },
    { "id": 1172, "name": "Sapang" },
    { "id": 1173, "name": "Sapat" },
    { "id": 1174, "name": "Sibut" },
    { "id": 1175, "name": "Tawid" },
    { "id": 1176, "name": "Bimmanga" },
    { "id": 1177, "name": "Cacanem" },
    { "id": 1178, "name": "Matagdao" },
    { "id": 1179, "name": "Minanga" },
    { "id": 1180, "name": "Pablacion" },
    { "id": 1181, "name": "Pugo" },
    { "id": 1182, "name": "Taytay" }
],
'Gregorio del Pilar': [
    { "id": 1183, "name": "Aluling" },
    { "id": 1184, "name": "Bussot" },
    { "id": 1185, "name": "Concepcion" },
    { "id": 1186, "name": "Dapdappig" },
    { "id": 1187, "name": "Patac" },
    { "id": 1188, "name": "San Juan" },
    { "id": 1189, "name": "Santo Tomas" }
],
'Magsingal': [
    { "id": 1190, "name": "Bimmanga" },
    { "id": 1191, "name": "Mindoro" },
    { "id": 1192, "name": "Namalpalan" },
    { "id": 1193, "name": "San Ramon" },
    { "id": 1194, "name": "San Isidro" },
    { "id": 1195, "name": "Bancao" },
    { "id": 1196, "name": "Rizal" },
    { "id": 1197, "name": "Santo Tomas" },
    { "id": 1198, "name": "Santiago" },
    { "id": 1199, "name": "San Rafael" },
    { "id": 1200, "name": "Matabungkay" },
    { "id": 1201, "name": "Dandanac" },
    { "id": 1202, "name": "Calumpang" },
    { "id": 1203, "name": "Labiang" },
    { "id": 1204, "name": "San Juan" },
    { "id": 1205, "name": "Santo Domingo" }
],
'Nagbukel': [
    { "id": 1139, "name": "Barangay I" },
    { "id": 1140, "name": "Barangay II" },
    { "id": 1141, "name": "Baringcua" },
    { "id": 1142, "name": "Bonifacio" },
    { "id": 1143, "name": "Poblacion" },
    { "id": 1144, "name": "Pug-os" },
    { "id": 1145, "name": "San Antonio" },
    { "id": 1146, "name": "San Juan" },
    { "id": 1147, "name": "San Pedro" },
    { "id": 1148, "name": "San Vicente" },
    { "id": 1149, "name": "Santa Cruz" },
    { "id": 1150, "name": "Santa Lucia" }
],
'Narvacan': [
    { "id": 1151, "name": "Aguas" },
    { "id": 1152, "name": "Aningway" },
    { "id": 1153, "name": "Bantay" },
    { "id": 1154, "name": "Baroro" },
    { "id": 1155, "name": "Basing" },
    { "id": 1156, "name": "Batang" },
    { "id": 1157, "name": "Calagbagan" },
    { "id": 1158, "name": "Daldalusip" },
    { "id": 1159, "name": "Gabu" },
    { "id": 1160, "name": "Libaton" },
    { "id": 1161, "name": "Lunsad" },
    { "id": 1162, "name": "Nabua" },
    { "id": 1163, "name": "Nagsangalan" },
    { "id": 1164, "name": "Patupat" },
    { "id": 1165, "name": "Poblacion" },
    { "id": 1166, "name": "Pug-os" },
    { "id": 1167, "name": "Quezon" },
    { "id": 1168, "name": "San Isidro" },
    { "id": 1169, "name": "San Juan" },
    { "id": 1170, "name": "San Marcos" },
    { "id": 1171, "name": "San Pedro" },
    { "id": 1172, "name": "San Vicente" }
],
'Quirino': [
    { "id": 1173, "name": "Bagumbayan" },
    { "id": 1174, "name": "San Antonio" },
    { "id": 1175, "name": "San Isidro" },
    { "id": 1176, "name": "San Juan" },
    { "id": 1177, "name": "San Vicente" },
    { "id": 1178, "name": "Santa Maria" }
],
'Salcedo': [
    { "id": 1179, "name": "Santa Lucia" },
    { "id": 1180, "name": "Sta. Maria" },
    { "id": 1181, "name": "Poblacion" },
    { "id": 1182, "name": "San Isidro" },
    { "id": 1183, "name": "San Pedro" }
],
'San Emilio': [
    { "id": 1184, "name": "Nagtagil" },
    { "id": 1185, "name": "Naguidet" },
    { "id": 1186, "name": "Poblacion" },
    { "id": 1187, "name": "San Isidro" },
    { "id": 1188, "name": "San Pedro" }
],
'San Esteban': [
    { "id": 1189, "name": "Angayao" },
    { "id": 1190, "name": "Bulo" },
    { "id": 1191, "name": "Poblacion" },
    { "id": 1192, "name": "San Isidro" },
    { "id": 1193, "name": "San Antonio" },
    { "id": 1194, "name": "San Juan" },
    { "id": 1195, "name": "San Vicente" }
],
'San Ildefonso': [
    { "id": 1196, "name": "San Andres" },
    { "id": 1197, "name": "San Agustin" },
    { "id": 1198, "name": "San Guillermo" },
    { "id": 1199, "name": "San Isidro" },
    { "id": 1200, "name": "San Jose" },
    { "id": 1201, "name": "San Juan" },
    { "id": 1202, "name": "San Pablo" },
    { "id": 1203, "name": "San Vicente" },
    { "id": 1204, "name": "Poblacion" },
    { "id": 1205, "name": "Palisoc" }
],
'San Juan': [
    { "id": 1206, "name": "Agpao" },
    { "id": 1207, "name": "Alab" },
    { "id": 1208, "name": "Alin" },
    { "id": 1209, "name": "Capang" },
    { "id": 1210, "name": "Galimuyod" },
    { "id": 1211, "name": "Gamang" },
    { "id": 1212, "name": "Imat" },
    { "id": 1213, "name": "Magsaysay" },
    { "id": 1214, "name": "Poblacion" },
    { "id": 1215, "name": "Quinale" }
],
'San Vicente': [
    { "id": 1216, "name": "Cabaroan" },
    { "id": 1217, "name": "San Jose" },
    { "id": 1218, "name": "San Pedro" },
    { "id": 1219, "name": "Poblacion" },
    { "id": 1220, "name": "Pangdan" }
],
'Santa Catalina': [
    { "id": 1221, "name": "Bacas" },
    { "id": 1222, "name": "Guiset" },
    { "id": 1223, "name": "Imelda" },
    { "id": 1224, "name": "Poblacion" },
    { "id": 1225, "name": "San Antonio" },
    { "id": 1226, "name": "San Isidro" },
    { "id": 1227, "name": "San Vicente" },
    { "id": 1228, "name": "Tagodtod" },
    { "id": 1229, "name": "Tugos" }
],
'Santa Cruz': [
    { "id": 1230, "name": "Bito" },
    { "id": 1231, "name": "Casiligan" },
    { "id": 1232, "name": "Poblacion" },
    { "id": 1233, "name": "San Esteban" },
    { "id": 1234, "name": "San Francisco" },
    { "id": 1235, "name": "San Juan" },
    { "id": 1236, "name": "San Pedro" }
],
'Santa Lucia': [
    { "id": 1237, "name": "Balbalungao" },
    { "id": 1238, "name": "Bungro" },
    { "id": 1239, "name": "Poblacion" },
    { "id": 1240, "name": "San Isidro" },
    { "id": 1241, "name": "San Juan" }
],
'Santa Maria': [
    { "id": 1242, "name": "Agpao" },
    { "id": 1243, "name": "Bado" },
    { "id": 1244, "name": "Balacbac" },
    { "id": 1245, "name": "Bical" },
    { "id": 1246, "name": "Bungro" },
    { "id": 1247, "name": "Dagupan" },
    { "id": 1248, "name": "Galvan" }
],
'Santiago': [
    { "id": 1249, "name": "Agpayao" },
    { "id": 1250, "name": "Bical" },
    { "id": 1251, "name": "Bugarin" },
    { "id": 1252, "name": "Dulag" },
    { "id": 1253, "name": "Magsaysay" },
    { "id": 1254, "name": "Poblacion" },
    { "id": 1255, "name": "San Vicente" },
    { "id": 1256, "name": "Santa Cruz" }
],
'Sinait': [
    { "id": 1257, "name": "Barit" },
    { "id": 1258, "name": "Cabugao" },
    { "id": 1259, "name": "Danan" },
    { "id": 1260, "name": "Dulog" },
    { "id": 1261, "name": "Loquia" },
    { "id": 1262, "name": "Nagtupacan" },
    { "id": 1263, "name": "Poblacion" },
    { "id": 1264, "name": "San Antonio" }
],
'Suyo': [
    { "id": 1265, "name": "Bical" },
    { "id": 1266, "name": "San Isidro" },
    { "id": 1267, "name": "San Vicente" },
    { "id": 1268, "name": "Suyo" },
    { "id": 1269, "name": "Barangay I" }
],
'Tagudin': [
    { "id": 1270, "name": "Bacao" },
    { "id": 1271, "name": "Poblacion" },
    { "id": 1272, "name": "San Juan" },
    { "id": 1273, "name": "San Pedro" },
    { "id": 1274, "name": "San Vicente" },
    { "id": 1275, "name": "Tagudin Proper" }
],
'San Fernando City': [
    { "id": 1276, "name": "Agdao" },
    { "id": 1277, "name": "Balucuc" },
    { "id": 1278, "name": "Catbangen" },
    { "id": 1279, "name": "Dabubuan" },
    { "id": 1280, "name": "Dawel" },
    { "id": 1281, "name": "Lingsat" },
    { "id": 1282, "name": "Poblacion" },
    { "id": 1283, "name": "Portic" }
],
'Agoo': [
    { "id": 1284, "name": "Alos" },
    { "id": 1285, "name": "Baccuit Sur" },
    { "id": 1286, "name": "Bacnotan" },
    { "id": 1287, "name": "Poblacion" }
],
'Aringay': [
    { "id": 1288, "name": "Baguio" },
    { "id": 1289, "name": "Banawel" },
    { "id": 1290, "name": "Bawang" },
    { "id": 1291, "name": "Kinalansan" }
],
'Bacnotan': [
    { "id": 1292, "name": "Agno" },
    { "id": 1293, "name": "Amontoc" },
    { "id": 1294, "name": "Bambang" },
    { "id": 1295, "name": "Bunga" }
],
'Bagulin': [
    { "id": 1296, "name": "Burgos" },
    { "id": 1297, "name": "Cabugao" },
    { "id": 1298, "name": "Cabuntog" },
    { "id": 1299, "name": "Luzon" }
],
'Balaoan': [
    { "id": 1300, "name": "Banaoang" },
    { "id": 1301, "name": "Caoayan" },
    { "id": 1302, "name": "Poblacion" }
],
'Bangar': [
    { "id": 1303, "name": "Abang" },
    { "id": 1304, "name": "Baclig" },
    { "id": 1305, "name": "Cadaclan" },
    { "id": 1306, "name": "Calabaan" }
],
'Bauang': [
    { "id": 1307, "name": "Bacnotan" },
    { "id": 1308, "name": "Bacling" },
    { "id": 1309, "name": "Bola" }
],
'Burgos': [
    { "id": 1310, "name": "Bangao" },
    { "id": 1311, "name": "Cabaruan" },
    { "id": 1312, "name": "Macatbong" }
],
'Caba': [
    { "id": 1313, "name": "Barumbong" },
    { "id": 1314, "name": "Burgos" },
    { "id": 1315, "name": "Cabatuan" }
],
'Luna': [
    { "id": 1316, "name": "Dalandan" },
    { "id": 1317, "name": "Pasukin" },
    { "id": 1318, "name": "Bacungao" }
],
'Naguilian': [
    { "id": 1319, "name": "Dibut" },
    { "id": 1320, "name": "Poblacion" },
    { "id": 1321, "name": "Pucay" }
],
'Pugo': [
    { "id": 1322, "name": "Atab" },
    { "id": 1323, "name": "Poblacion" },
    { "id": 1324, "name": "Suso" }
],
'Rosario': [
    { "id": 1325, "name": "Bunga" },
    { "id": 1326, "name": "Poblacion" },
    { "id": 1327, "name": "Lunas" }
],
'San Gabriel': [
    { "id": 1328, "name": "Tianac" },
    { "id": 1329, "name": "San Guillermo" },
    { "id": 1330, "name": "San Antonio" }
],
'San Juan': [
    { "id": 1331, "name": "Anguin" },
    { "id": 1332, "name": "Poblacion" },
    { "id": 1333, "name": "Arosip" }
],
'San Luis': [
    { "id": 1334, "name": "Bagbag" },
    { "id": 1335, "name": "Poblacion" },
    { "id": 1336, "name": "Bana" }
],
'San Mariano': [
    { "id": 1337, "name": "Bagumbayan" },
    { "id": 1338, "name": "Poblacion" },
    { "id": 1339, "name": "Guitol" }
],
'San Nicolas': [
    { "id": 1340, "name": "Bantay" },
    { "id": 1341, "name": "Banban" },
    { "id": 1342, "name": "Caranglaan" }
],
'San Quirico': [
    { "id": 1343, "name": "Baguio" },
    { "id": 1344, "name": "Carmel" },
    { "id": 1345, "name": "Lubing" }
],
'Santol': [
    { "id": 1346, "name": "Balanacan" },
    { "id": 1347, "name": "Angayan" },
    { "id": 1348, "name": "Tagang" }
],
'Santo Tomas': [
    { "id": 1349, "name": "Bal-lasi" },
    { "id": 1350, "name": "Binablacan" },
    { "id": 1351, "name": "Baba" }
],
'Sison': [
    { "id": 1352, "name": "Urbano" },
    { "id": 1353, "name": "Poblacion" },
    { "id": 1354, "name": "Anguis" }
],
'Sudipen': [
    { "id": 1355, "name": "Santo Tomas" },
    { "id": 1356, "name": "Aguinaldo" },
    { "id": 1357, "name": "Atunayan" }
],
'Dagupan City': [
    { "id": 1358, "name": "Bonuan Boquig" },
    { "id": 1359, "name": "Bonuan Gueset" },
    { "id": 1360, "name": "Calaocan" },
    { "id": 1361, "name": "Caranglaan" },
    { "id": 1362, "name": "Cayanga" },
    { "id": 1363, "name": "Daluwen" },
    { "id": 1364, "name": "East Pangasinan" },
    { "id": 1365, "name": "Magsaysay" },
    { "id": 1366, "name": "Poblacion" },
    { "id": 1367, "name": "Tico" }
],
'San Carlos City': [
    { "id": 1368, "name": "Banaba" },
    { "id": 1369, "name": "Dianay" },
    { "id": 1370, "name": "Nagueras" },
    { "id": 1371, "name": "Poblacion" },
    { "id": 1372, "name": "Sapa" },
    { "id": 1373, "name": "Tondol" }
],
'Urdaneta City': [
    { "id": 1374, "name": "Agcolawang" },
    { "id": 1375, "name": "Alipangpang" },
    { "id": 1376, "name": "Amamperez" },
    { "id": 1377, "name": "Dinaonan" },
    { "id": 1378, "name": "Langayan" },
    { "id": 1379, "name": "Mapangpangan" },
    { "id": 1380, "name": "Poblacion" }
],
'Agno': [
    { "id": 1381, "name": "Aloleng" },
    { "id": 1382, "name": "Balangobong" },
    { "id": 1383, "name": "Cruz" },
    { "id": 1384, "name": "Poblacion" },
    { "id": 1385, "name": "Sangil" }
],
'Aguilar': [
    { "id": 1386, "name": "Alang" },
    { "id": 1387, "name": "Poblacion" },
    { "id": 1388, "name": "San Juan" }
],
'Alaminos': [
    { "id": 1389, "name": "Alitaya" },
    { "id": 1390, "name": "Bolasi" },
    { "id": 1391, "name": "Dinalupihan" },
    { "id": 1392, "name": "Poblacion" }
],
'Anda': [
    { "id": 1393, "name": "Bangon" },
    { "id": 1394, "name": "Capangpang" },
    { "id": 1395, "name": "Poblacion" }
],
'Asingan': [
    { "id": 1396, "name": "Alicia" },
    { "id": 1397, "name": "Poblacion" },
    { "id": 1398, "name": "San Vicente" }
],
'Balungao': [
    { "id": 1399, "name": "Amamperez" },
    { "id": 1400, "name": "Ballas" },
    { "id": 1401, "name": "Mabilao" }
],
'Bani': [
    { "id": 1402, "name": "Bani Proper" },
    { "id": 1403, "name": "Basilan" },
    { "id": 1404, "name": "Banban" },
    { "id": 1405, "name": "Ronggoy" },
    { "id": 1406, "name": "Talogtog" }
],
'Basista': [
    { "id": 1407, "name": "Aguho" },
    { "id": 1408, "name": "Banaoang" },
    { "id": 1409, "name": "Bantayan" },
    { "id": 1410, "name": "Bilibinwang" },
    { "id": 1411, "name": "Poblacion" }
],
'Bayambang': [
    { "id": 1412, "name": "Alipangpang" },
    { "id": 1413, "name": "Bani" },
    { "id": 1414, "name": "Bantog" },
    { "id": 1415, "name": "Bangbang" },
    { "id": 1416, "name": "Barangay Poblacion" }
],
'Binalonan': [
    { "id": 1417, "name": "Barangay Poblacion" },
    { "id": 1418, "name": "Buenlag" },
    { "id": 1419, "name": "Bued" },
    { "id": 1420, "name": "Maguisguis" }
],
'Binmaley': [
    { "id": 1421, "name": "Bancao-Bancao" },
    { "id": 1422, "name": "Bangug" },
    { "id": 1423, "name": "Bati" },
    { "id": 1424, "name": "Poblacion" }
],
'Bolinao': [
    { "id": 1425, "name": "Alos" },
    { "id": 1426, "name": "Bani" },
    { "id": 1427, "name": "Bolinao Proper" },
    { "id": 1428, "name": "Burgos" }
],
'Bugallon': [
    { "id": 1429, "name": "Bancao" },
    { "id": 1430, "name": "Barbar" },
    { "id": 1431, "name": "Bolasi" }
],
'Burgos': [
    { "id": 1432, "name": "Basilan" },
    { "id": 1433, "name": "Binabalian" },
    { "id": 1434, "name": "Cacandungan" },
    { "id": 1435, "name": "Cadiao" }
],
'Calasiao': [
    { "id": 1436, "name": "Bancao" },
    { "id": 1437, "name": "Binalonan" },
    { "id": 1438, "name": "Carusocan" },
    { "id": 1439, "name": "Poblacion" }
],
'Dasol': [
    { "id": 1440, "name": "Bañaga" },
    { "id": 1441, "name": "Caoayan" },
    { "id": 1442, "name": "Baleg" }
],
'Infanta': [
    { "id": 1443, "name": "Basilan" },
    { "id": 1444, "name": "Bilogbilog" },
    { "id": 1445, "name": "Cabatuan" },
    { "id": 1446, "name": "Dumaliw" }
],
'Labrador': [
    { "id": 1447, "name": "Barangay San Agustin" },
    { "id": 1448, "name": "Poblacion" },
    { "id": 1449, "name": "San Jose" }
],
'Lingayen': [
    { "id": 1450, "name": "Bani" },
    { "id": 1451, "name": "Baybay" },
    { "id": 1452, "name": "Bued" },
    { "id": 1453, "name": "Poblacion" }
],
'Manaoag': [
    { "id": 1454, "name": "Bingao" },
    { "id": 1455, "name": "Boquig" },
    { "id": 1456, "name": "Naguilian" },
    { "id": 1457, "name": "Poblacion" }
],
'Mangaldan': [
    { "id": 1458, "name": "Amamperez" },
    { "id": 1459, "name": "Balingueo" },
    { "id": 1460, "name": "Barangay Poblacion" }
],
'Mangatarem': [
    { "id": 1461, "name": "Alitaya" },
    { "id": 1462, "name": "Bilogbilog" },
    { "id": 1463, "name": "Luna" },
    { "id": 1464, "name": "Poblacion" }
],
'Natividad': [
    { "id": 1465, "name": "Alitaya" },
    { "id": 1466, "name": "Bagumbayan" },
    { "id": 1467, "name": "Bantay" },
    { "id": 1468, "name": "Cabuloan" }
],
'Pozorrubio': [
    { "id": 1469, "name": "Alang" },
    { "id": 1470, "name": "Banang" },
    { "id": 1471, "name": "Burgos" },
    { "id": 1472, "name": "Poblacion" }
],
'Rosales': [
    { "id": 1473, "name": "Balaoan" },
    { "id": 1474, "name": "Dulong Bayan" },
    { "id": 1475, "name": "Langgapan" },
    { "id": 1476, "name": "Malasat" }
],
'San Fabian': [
    { "id": 1477, "name": "Cawayan" },
    { "id": 1478, "name": "Langangan" },
    { "id": 1479, "name": "Poblacion" },
    { "id": 1480, "name": "San Isidro" }
],
'San Jacinto': [
    { "id": 1481, "name": "Bangus" },
    { "id": 1482, "name": "Cacandungan" },
    { "id": 1483, "name": "Dioquino" },
    { "id": 1484, "name": "Poblacion" }
],
'San Manuel': [
    { "id": 1485, "name": "Balaybay" },
    { "id": 1486, "name": "Buli" },
    { "id": 1487, "name": "Poblacion" }
],
'San Nicolas': [
    { "id": 1488, "name": "Basang" },
    { "id": 1489, "name": "Bediao" },
    { "id": 1490, "name": "Langangan" },
    { "id": 1491, "name": "Poblacion" }
],
'San Quintin': [
    { "id": 1492, "name": "Agpay" },
    { "id": 1493, "name": "Bayao" },
    { "id": 1494, "name": "Cacandungan" },
    { "id": 1495, "name": "Dacbucad" }
],
'Santa Barbara': [
    { "id": 1496, "name": "Agbayao" },
    { "id": 1497, "name": "Barbaza" },
    { "id": 1498, "name": "Bansang" },
    { "id": 1499, "name": "Poblacion" }
],
'Santa Maria': [
    { "id": 1500, "name": "Balaybay" },
    { "id": 1501, "name": "Bajo" },
    { "id": 1502, "name": "Bangan" },
    { "id": 1503, "name": "Poblacion" }
],
'Santo Tomas': [
    { "id": 1504, "name": "Alang" },
    { "id": 1505, "name": "Burgos" },
    { "id": 1506, "name": "Catabbagan" },
    { "id": 1507, "name": "Poblacion" }
],
'Sison': [
    { "id": 1508, "name": "Alang" },
    { "id": 1509, "name": "Bantog" },
    { "id": 1510, "name": "Bolinao" },
    { "id": 1511, "name": "Poblacion" }
],
'Tayug': [
    { "id": 1512, "name": "Balingueo" },
    { "id": 1513, "name": "Banay-Banay" },
    { "id": 1514, "name": "Dumalig" },
    { "id": 1515, "name": "Poblacion" }
],
'Umingan': [
    { "id": 1516, "name": "Alang" },
    { "id": 1517, "name": "Bangon" },
    { "id": 1518, "name": "Digos" },
    { "id": 1519, "name": "Poblacion" }
],
'Urbiztondo': [
    { "id": 1520, "name": "Binmaley" },
    { "id": 1521, "name": "Bolasi" },
    { "id": 1522, "name": "Buenlag" },
    { "id": 1523, "name": "Poblacion" }
],
'Villasis': [
    { "id": 1524, "name": "Bamban" },
    { "id": 1525, "name": "Bayan" },
    { "id": 1526, "name": "Mabilao" },
    { "id": 1527, "name": "Poblacion" }
],
'Basco': [
    { "id": 1528, "name": "Chanarian" },
    { "id": 1529, "name": "Ihubok I" },
    { "id": 1530, "name": "Ihubok II" },
    { "id": 1531, "name": "Kayhuvokan" },
    { "id": 1532, "name": "San Antonio" },
    { "id": 1533, "name": "San Joaquin" }
],
'Itbayat': [
    { "id": 1534, "name": "Raele" },
    { "id": 1535, "name": "San Rafael" },
    { "id": 1536, "name": "Santa Lucia" },
    { "id": 1537, "name": "Santa Maria" },
    { "id": 1538, "name": "Santa Rosa" }
],
'Sabtang': [
    { "id": 1539, "name": "Chavayan" },
    { "id": 1540, "name": "Malakdang" },
    { "id": 1541, "name": "Nakanmuan" },
    { "id": 1542, "name": "Savidug" },
    { "id": 1543, "name": "Sinakan" },
    { "id": 1544, "name": "Sumnanga" }
],
'Uyugan': [
    { "id": 1545, "name": "Imnajbu" },
    { "id": 1546, "name": "Itbud" },
    { "id": 1547, "name": "Kayuganan" },
    { "id": 1548, "name": "Kayvaluganan" }
],
"Tuguegarao City": [
    { "id": 1549, "name": "Balzain" },
    { "id": 1550, "name": "Carig" },
    { "id": 1551, "name": "Centro" },
    { "id": 1552, "name": "San Gabriel" },
    { "id": 1553, "name": "San Juan" },
    { "id": 1554, "name": "San Pedro" },
    { "id": 1555, "name": "San Vicente" },
    { "id": 1556, "name": "Santiago" },
    { "id": 1557, "name": "Tucal" },
    { "id": 1558, "name": "Villa" },
    { "id": 1559, "name": "Centro II" },
    { "id": 1560, "name": "San Mariano" },
    { "id": 1561, "name": "Bagumbayan" }
  ],
  "Cauayan City": [
    { "id": 1562, "name": "District I" },
    { "id": 1563, "name": "District II" },
    { "id": 1564, "name": "District III" },
    { "id": 1565, "name": "District IV" },
    { "id": 1566, "name": "District V" },
    { "id": 1567, "name": "District VI" },
    { "id": 1568, "name": "District VII" },
    { "id": 1569, "name": "District VIII" },
    { "id": 1570, "name": "District IX" },
    { "id": 1571, "name": "District X" },
    { "id": 1572, "name": "District XI" },
    { "id": 1573, "name": "District XII" },
    { "id": 1574, "name": "District XIII" }
  ],
  "Abulug": [
    { "id": 1575, "name": "Paddaya" },
    { "id": 1576, "name": "Paruddun Sur" },
    { "id": 1577, "name": "San Antonio" },
    { "id": 1578, "name": "San Jose" },
    { "id": 1579, "name": "San Juan" }
  ],
  "Alcala": [
    { "id": 1580, "name": "Camambugan" },
    { "id": 1581, "name": "San Juan" },
    { "id": 1582, "name": "San Pedro" },
    { "id": 1583, "name": "San Isidro" },
    { "id": 1584, "name": "San Vicente" }
  ],
  "Allacapan": [
    { "id": 1585, "name": "Allacapan" },
    { "id": 1586, "name": "Baretbet" },
    { "id": 1587, "name": "Dalig" },
    { "id": 1588, "name": "San Pedro" },
    { "id": 1589, "name": "Santa Teresa" }
  ],
  "Amulung": [
    { "id": 1590, "name": "Banaoang" },
    { "id": 1591, "name": "Linauan" },
    { "id": 1592, "name": "Pio" },
    { "id": 1593, "name": "San Andres" },
    { "id": 1594, "name": "San Gabriel" }
  ],
  "Aparri": [
    { "id": 1595, "name": "Paddaya" },
    { "id": 1596, "name": "Punta" },
    { "id": 1597, "name": "San Antonio" },
    { "id": 1598, "name": "San Juan" },
    { "id": 1599, "name": "San Vicente" }
  ],
  "Baggao": [
    { "id": 1600, "name": "Luna" },
    { "id": 1601, "name": "Mabini" },
    { "id": 1602, "name": "San Juan" },
    { "id": 1603, "name": "Santo Niño" },
    { "id": 1604, "name": "San Pablo" }
  ],
  "Ballesteros": [
    { "id": 1605, "name": "San Isidro" },
    { "id": 1606, "name": "San Miguel" },
    { "id": 1607, "name": "Santa Cruz" },
    { "id": 1608, "name": "San Pedro" },
    { "id": 1609, "name": "Villa" }
  ],
  "Buguey": [
    { "id": 1610, "name": "Apayao" },
    { "id": 1611, "name": "Lual" },
    { "id": 1612, "name": "San Pablo" },
    { "id": 1613, "name": "San Vicente" },
    { "id": 1614, "name": "Tina" }
  ],
  "Calayan": [
    { "id": 1615, "name": "Balintang" },
    { "id": 1616, "name": "San Jose" },
    { "id": 1617, "name": "Santo Niño" },
    { "id": 1618, "name": "Santa Cruz" },
    { "id": 1619, "name": "Santa Maria" }
  ],
  "Camalaniugan": [
    { "id": 1620, "name": "Cabatuan" },
    { "id": 1621, "name": "Calasag" },
    { "id": 1622, "name": "Carayan" },
    { "id": 1623, "name": "San Juan" },
    { "id": 1624, "name": "San Vicente" }
  ],
  "Claveria": [
    { "id": 1625, "name": "Bagumbayan" },
    { "id": 1626, "name": "Cabalan" },
    { "id": 1627, "name": "Carutap" },
    { "id": 1628, "name": "San Antonio" },
    { "id": 1629, "name": "Santa Cruz" }
  ],
  "Enrile": [
    { "id": 1630, "name": "Batal" },
    { "id": 1631, "name": "Bilang" },
    { "id": 1632, "name": "Casigayan" },
    { "id": 1633, "name": "San Juan" },
    { "id": 1634, "name": "San Vicente" }
  ],
  "Gonzaga": [
    { "id": 1635, "name": "Bacungan" },
    { "id": 1636, "name": "Cabangaran" },
    { "id": 1637, "name": "Lablab" },
    { "id": 1638, "name": "Mabini" },
    { "id": 1639, "name": "San Juan" }
  ],
  "Iguig": [
    { "id": 1640, "name": "Abucay" },
    { "id": 1641, "name": "Alimbuyog" },
    { "id": 1642, "name": "Dait" },
    { "id": 1643, "name": "San Pedro" },
    { "id": 1644, "name": "Santa Maria" }
  ],
  "Lasam": [
    { "id": 1645, "name": "Binalonan" },
    { "id": 1646, "name": "Burgos" },
    { "id": 1647, "name": "Concepcion" },
    { "id": 1648, "name": "Manalpac" },
    { "id": 1649, "name": "San Vicente" }
  ],
  "Lallo": [
    { "id": 1650, "name": "Barangay I" },
    { "id": 1651, "name": "Barangay II" },
    { "id": 1652, "name": "Barangay III" },
    { "id": 1653, "name": "Barangay IV" },
    { "id": 1654, "name": "Barangay V" }
  ],
  "Lal-lo": [
    { "id": 1655, "name": "Poblacion" },
    { "id": 1656, "name": "Cagayan" },
    { "id": 1657, "name": "Dalacdac" },
    { "id": 1658, "name": "San Jose" },
    { "id": 1659, "name": "San Pedro" }
  ],
  "Sanchez Mira": [
    { "id": 1660, "name": "Camabaan" },
    { "id": 1661, "name": "Conception" },
    { "id": 1662, "name": "Marang" },
    { "id": 1663, "name": "San Isidro" },
    { "id": 1664, "name": "San Vicente" }
  ],
  "Santa Ana": [
    { "id": 1665, "name": "Bautista" },
    { "id": 1666, "name": "San Pedro" },
    { "id": 1667, "name": "Bato" },
    { "id": 1668, "name": "Centro" },
    { "id": 1669, "name": "Santa Maria" }
  ],
  "Santa Cruz": [
    { "id": 1670, "name": "San Antonio" },
    { "id": 1671, "name": "San Felipe" },
    { "id": 1672, "name": "San Vicente" },
    { "id": 1673, "name": "Santo Niño" },
    { "id": 1674, "name": "Santa Fe" }
  ],
  "Santa Teresita": [
    { "id": 1675, "name": "Barangay I" },
    { "id": 1676, "name": "Barangay II" },
    { "id": 1677, "name": "Barangay III" },
    { "id": 1678, "name": "Barangay IV" },
    { "id": 1679, "name": "Barangay V" }
  ],
  "Santo Niño": [
    { "id": 1680, "name": "Barangay I" },
    { "id": 1681, "name": "Barangay II" },
    { "id": 1682, "name": "Barangay III" },
    { "id": 1683, "name": "Barangay IV" },
    { "id": 1684, "name": "Barangay V" }
  ],
  "Solana": [
    { "id": 1685, "name": "Barangay I" },
    { "id": 1686, "name": "Barangay II" },
    { "id": 1687, "name": "Barangay III" },
    { "id": 1688, "name": "Barangay IV" },
    { "id": 1689, "name": "Barangay V" }
  ],
  "Tuao": [
    { "id": 1690, "name": "Barangay I" },
    { "id": 1691, "name": "Barangay II" },
    { "id": 1692, "name": "Barangay III" },
    { "id": 1693, "name": "Barangay IV" },
    { "id": 1694, "name": "Barangay V" }
  ],
  "Ilagan City": [
    { "id": 1700, "name": "Alibago" },
    { "id": 1701, "name": "Angadi" },
    { "id": 1702, "name": "Concepcion" },
    { "id": 1703, "name": "Dalisay" },
    { "id": 1704, "name": "Divisoria" }
  ],
  "Santiago City": [
    { "id": 1705, "name": "Bagumbayan" },
    { "id": 1706, "name": "San Vicente" },
    { "id": 1707, "name": "San Juan" },
    { "id": 1708, "name": "Poblacion" },
    { "id": 1709, "name": "Alfonso" }
  ],
  "Alfonso Castañeda": [
    { "id": 1710, "name": "Cacamilingan" },
    { "id": 1711, "name": "Cacamilingan Norte" },
    { "id": 1712, "name": "Labney" },
    { "id": 1713, "name": "Poblacion" },
    { "id": 1714, "name": "San Juan" }
  ],
  "Angadanan": [
    { "id": 1715, "name": "Barangay I" },
    { "id": 1716, "name": "Barangay II" },
    { "id": 1717, "name": "San Juan" },
    { "id": 1718, "name": "San Antonio" },
    { "id": 1719, "name": "Santo Niño" }
  ],
  "Aurora": [
    { "id": 1720, "name": "Barangay I" },
    { "id": 1721, "name": "Barangay II" },
    { "id": 1722, "name": "San Pedro" },
    { "id": 1723, "name": "Santo Niño" },
    { "id": 1724, "name": "San Vicente" }
  ],
  "Benito Soliven": [
    { "id": 1725, "name": "Barangay I" },
    { "id": 1726, "name": "Barangay II" },
    { "id": 1727, "name": "San Isidro" },
    { "id": 1728, "name": "San Agustin" },
    { "id": 1729, "name": "San Pablo" }
  ],
  "Cabagan": [
    { "id": 1730, "name": "Barangay I" },
    { "id": 1731, "name": "Barangay II" },
    { "id": 1732, "name": "Concepcion" },
    { "id": 1733, "name": "Dalandan" },
    { "id": 1734, "name": "Manggahan" }
  ],
  "Cabatuan": [
    { "id": 1735, "name": "Barangay I" },
    { "id": 1736, "name": "Barangay II" },
    { "id": 1737, "name": "San Jose" },
    { "id": 1738, "name": "San Juan" },
    { "id": 1739, "name": "Santo Niño" }
  ],
  "Delfin Albano": [
    { "id": 1740, "name": "Barangay I" },
    { "id": 1741, "name": "Barangay II" },
    { "id": 1742, "name": "Bayanihan" },
    { "id": 1743, "name": "Dimalanta" },
    { "id": 1744, "name": "Santo Niño" }
  ],
  "Dinapigue": [
    { "id": 1745, "name": "Barangay I" },
    { "id": 1746, "name": "Barangay II" },
    { "id": 1747, "name": "San Isidro" },
    { "id": 1748, "name": "San Vicente" },
    { "id": 1749, "name": "Santo Niño" }
  ],
  "Echague": [
    { "id": 1750, "name": "Barangay I" },
    { "id": 1751, "name": "Barangay II" },
    { "id": 1752, "name": "Bantug" },
    { "id": 1753, "name": "Caloocan" },
    { "id": 1754, "name": "San Antonio" }
  ],
  "Gamu": [
    { "id": 1755, "name": "Barangay I" },
    { "id": 1756, "name": "Barangay II" },
    { "id": 1757, "name": "Bantug" },
    { "id": 1758, "name": "Caloocan" },
    { "id": 1759, "name": "San Agustin" }
  ],
  "Jones": [
    { "id": 1760, "name": "Barangay I" },
    { "id": 1761, "name": "Barangay II" },
    { "id": 1762, "name": "Cabatuan" },
    { "id": 1763, "name": "Bantug" },
    { "id": 1764, "name": "San Antonio" }
  ],
  "Naguilian": [
    { "id": 1765, "name": "Barangay I" },
    { "id": 1766, "name": "Barangay II" },
    { "id": 1767, "name": "Dungan" },
    { "id": 1768, "name": "San Jose" },
    { "id": 1769, "name": "San Vicente" }
  ],
  "Palanan": [
    { "id": 1770, "name": "Barangay I" },
    { "id": 1771, "name": "Barangay II" },
    { "id": 1772, "name": "Concepcion" },
    { "id": 1773, "name": "Maraboc" },
    { "id": 1774, "name": "San Juan" }
  ],
  "San Agustin": [
    { "id": 1775, "name": "Barangay I" },
    { "id": 1776, "name": "Barangay II" },
    { "id": 1777, "name": "San Jose" },
    { "id": 1778, "name": "Santo Niño" },
    { "id": 1779, "name": "San Vicente" }
  ],
  "San Guillermo": [
    { "id": 1780, "name": "Barangay I" },
    { "id": 1781, "name": "Barangay II" },
    { "id": 1782, "name": "San Pablo" },
    { "id": 1783, "name": "San Vicente" },
    { "id": 1784, "name": "Santa Fe" }
  ],
  "San Isidro": [
    { "id": 1785, "name": "Barangay I" },
    { "id": 1786, "name": "Barangay II" },
    { "id": 1787, "name": "Bayanihan" },
    { "id": 1788, "name": "Mabini" },
    { "id": 1789, "name": "San Vicente" }
  ],
  "San Mateo": [
    { "id": 1790, "name": "Barangay I" },
    { "id": 1791, "name": "Barangay II" },
    { "id": 1792, "name": "Bantug" },
    { "id": 1793, "name": "Caloocan" },
    { "id": 1794, "name": "San Vicente" }
  ],
  "San Mariano": [
    { "id": 1795, "name": "Barangay I" },
    { "id": 1796, "name": "Barangay II" },
    { "id": 1797, "name": "San Isidro" },
    { "id": 1798, "name": "San Vicente" },
    { "id": 1799, "name": "Santo Niño" }
  ],
  "San Pablo": [
    { "id": 1800, "name": "Barangay I" },
    { "id": 1801, "name": "Barangay II" },
    { "id": 1802, "name": "San Vicente" },
    { "id": 1803, "name": "Santa Maria" },
    { "id": 1804, "name": "San Juan" }
  ],
  "San Pedro": [
    { "id": 1805, "name": "Barangay I" },
    { "id": 1806, "name": "Barangay II" },
    { "id": 1807, "name": "Bayanihan" },
    { "id": 1808, "name": "Malaya" },
    { "id": 1809, "name": "San Vicente" }
  ],
  "San Rafael": [
    { "id": 1810, "name": "Barangay I" },
    { "id": 1811, "name": "Barangay II" },
    { "id": 1812, "name": "Santa Teresa" },
    { "id": 1813, "name": "San Isidro" },
    { "id": 1814, "name": "San Vicente" }
  ],
  "San Tomas": [
    { "id": 1815, "name": "Barangay I" },
    { "id": 1816, "name": "Barangay II" },
    { "id": 1817, "name": "San Mateo" },
    { "id": 1818, "name": "Santo Niño" },
    { "id": 1819, "name": "San Juan" }
  ],
  "Santo Tomas": [
    { "id": 1820, "name": "Barangay I" },
    { "id": 1821, "name": "Barangay II" },
    { "id": 1822, "name": "Bayanihan" },
    { "id": 1823, "name": "San Isidro" },
    { "id": 1824, "name": "Santa Teresa" }
  ],
  "Tumauini": [
    { "id": 1825, "name": "Barangay I" },
    { "id": 1826, "name": "Barangay II" },
    { "id": 1827, "name": "San Isidro" },
    { "id": 1828, "name": "Santa Teresa" },
    { "id": 1829, "name": "Bayanihan" }
  ],
  "Bayombong": [
    { "id": 1830, "name": "Barangay I" },
    { "id": 1831, "name": "Barangay II" },
    { "id": 1832, "name": "Alangilan" },
    { "id": 1833, "name": "Barong" },
    { "id": 1834, "name": "Bauang" }
  ],
  "Solano": [
    { "id": 1835, "name": "Barangay I" },
    { "id": 1836, "name": "Barangay II" },
    { "id": 1837, "name": "San Isidro" },
    { "id": 1838, "name": "San Pedro" },
    { "id": 1839, "name": "San Juan" }
  ],
  "Ambaguio": [
    { "id": 1840, "name": "Barangay I" },
    { "id": 1841, "name": "Barangay II" },
    { "id": 1842, "name": "San Isidro" },
    { "id": 1843, "name": "San Vicente" },
    { "id": 1844, "name": "San Rafael" }
  ],
  "Bagabag": [
    { "id": 1845, "name": "Barangay I" },
    { "id": 1846, "name": "Barangay II" },
    { "id": 1847, "name": "San Rafael" },
    { "id": 1848, "name": "San Pedro" },
    { "id": 1849, "name": "San Isidro" }
  ],
  "Burgos": [
    { "id": 1850, "name": "Barangay I" },
    { "id": 1851, "name": "Barangay II" },
    { "id": 1852, "name": "San Vicente" },
    { "id": 1853, "name": "San Pedro" },
    { "id": 1854, "name": "Burgos" }
  ],
  "Dupax del Norte": [
    { "id": 1855, "name": "Barangay I" },
    { "id": 1856, "name": "Barangay II" },
    { "id": 1857, "name": "San Isidro" },
    { "id": 1858, "name": "San Vicente" },
    { "id": 1859, "name": "San Juan" }
  ],
  "Dupax del Sur": [
    { "id": 1860, "name": "Barangay I" },
    { "id": 1861, "name": "Barangay II" },
    { "id": 1862, "name": "San Isidro" },
    { "id": 1863, "name": "San Vicente" },
    { "id": 1864, "name": "San Pedro" }
  ],
  "Kasibu": [
    { "id": 1865, "name": "Barangay I" },
    { "id": 1866, "name": "Barangay II" },
    { "id": 1867, "name": "San Vicente" },
    { "id": 1868, "name": "San Juan" },
    { "id": 1869, "name": "San Isidro" }
  ],
  "Kayapa": [
    { "id": 1870, "name": "Barangay I" },
    { "id": 1871, "name": "Barangay II" },
    { "id": 1872, "name": "San Vicente" },
    { "id": 1873, "name": "San Pedro" },
    { "id": 1874, "name": "San Juan" }
  ],
  "Quezon": [
    { "id": 1875, "name": "Barangay I" },
    { "id": 1876, "name": "Barangay II" },
    { "id": 1877, "name": "San Isidro" },
    { "id": 1878, "name": "San Vicente" },
    { "id": 1879, "name": "San Rafael" }
  ],
  "Villaverde": [
    { "id": 1880, "name": "Barangay I" },
    { "id": 1881, "name": "Barangay II" },
    { "id": 1882, "name": "San Vicente" },
    { "id": 1883, "name": "San Isidro" },
    { "id": 1884, "name": "San Juan" }
  ],
  "Cabarroguis": [
    { "id": 1885, "name": "Barangay I" },
    { "id": 1886, "name": "Barangay II" },
    { "id": 1887, "name": "San Antonio" },
    { "id": 1888, "name": "San Isidro" },
    { "id": 1889, "name": "San Vicente" }
  ],
  "Aglipay": [
    { "id": 1890, "name": "Barangay I" },
    { "id": 1891, "name": "Barangay II" },
    { "id": 1892, "name": "San Juan" },
    { "id": 1893, "name": "San Antonio" },
    { "id": 1894, "name": "San Isidro" }
  ],
  "Diffun": [
    { "id": 1895, "name": "Barangay I" },
    { "id": 1896, "name": "Barangay II" },
    { "id": 1897, "name": "San Rafael" },
    { "id": 1898, "name": "San Vicente" },
    { "id": 1899, "name": "San Juan" }
  ],
  "Maddela": [
    { "id": 1900, "name": "Barangay I" },
    { "id": 1901, "name": "Barangay II" },
    { "id": 1902, "name": "San Pedro" },
    { "id": 1903, "name": "San Isidro" },
    { "id": 1904, "name": "San Vicente" }
  ],
  "Nagtipunan": [
    { "id": 1905, "name": "Barangay I" },
    { "id": 1906, "name": "Barangay II" },
    { "id": 1907, "name": "San Juan" },
    { "id": 1908, "name": "San Antonio" },
    { "id": 1909, "name": "San Vicente" }
  ],
  "Saguday": [
    { "id": 1910, "name": "Barangay I" },
    { "id": 1911, "name": "Barangay II" },
    { "id": 1912, "name": "San Vicente" },
    { "id": 1913, "name": "San Juan" },
    { "id": 1914, "name": "San Antonio" }
  ],
  "Santiago": [
    { "id": 1915, "name": "Barangay I" },
    { "id": 1916, "name": "Barangay II" },
    { "id": 1917, "name": "San Isidro" },
    { "id": 1918, "name": "San Vicente" },
    { "id": 1919, "name": "San Antonio" }
  ],
  "Baler": [
    { "id": 1920, "name": "Barangay I" },
    { "id": 1921, "name": "Barangay II" },
    { "id": 1922, "name": "Biscaya" },
    { "id": 1923, "name": "Diteki" },
    { "id": 1924, "name": "Limao" }
  ],
  "Casiguran": [
    { "id": 1925, "name": "Barangay I" },
    { "id": 1926, "name": "Barangay II" },
    { "id": 1927, "name": "Maasin" },
    { "id": 1928, "name": "Sabang" },
    { "id": 1929, "name": "San Francisco" }
  ],
  "Dingalan": [
    { "id": 1930, "name": "Barangay I" },
    { "id": 1931, "name": "Barangay II" },
    { "id": 1932, "name": "Balite" },
    { "id": 1933, "name": "Ditumabo" },
    { "id": 1934, "name": "San Vicente" }
  ],
  "Dipaculao": [
    { "id": 1935, "name": "Barangay I" },
    { "id": 1936, "name": "Barangay II" },
    { "id": 1937, "name": "Bucal" },
    { "id": 1938, "name": "Culipapa" },
    { "id": 1939, "name": "San Luis" }
  ],
  "Maria Aurora": [
    { "id": 1940, "name": "Barangay I" },
    { "id": 1941, "name": "Barangay II" },
    { "id": 1942, "name": "Bungro" },
    { "id": 1943, "name": "Digmala" },
    { "id": 1944, "name": "San Pedro" }
  ],
  "San Luis": [
    { "id": 1945, "name": "Barangay I" },
    { "id": 1946, "name": "Barangay II" },
    { "id": 1947, "name": "Capangpangan" },
    { "id": 1948, "name": "Concepcion" },
    { "id": 1949, "name": "San Rafael" }
  ],
  "San Nicolas": [
    { "id": 1950, "name": "Barangay I" },
    { "id": 1951, "name": "Barangay II" },
    { "id": 1952, "name": "Bulalacao" },
    { "id": 1953, "name": "San Felipe" },
    { "id": 1954, "name": "San Vicente" }
  ],
  "San Juan": [
    { "id": 1955, "name": "Barangay I" },
    { "id": 1956, "name": "Barangay II" },
    { "id": 1957, "name": "Balcagan" },
    { "id": 1958, "name": "Culawit" },
    { "id": 1959, "name": "San Juan Norte" }
  ],
    "Balanga City": [
      { "id": 1960, "name": "Dinalupihan" },
      { "id": 1961, "name": "Longos" },
      { "id": 1962, "name": "Cupang" },
      { "id": 1963, "name": "Ibaugan" },
      { "id": 1964, "name": "Tunguhin" }
    ],
    "Mariveles": [
      { "id": 1965, "name": "Alion" },
      { "id": 1966, "name": "Bacao" },
      { "id": 1967, "name": "Cabayugan" },
      { "id": 1968, "name": "Limao" },
      { "id": 1969, "name": "Maligaya" }
    ],
    "Limay": [
      { "id": 1970, "name": "Bunga" },
      { "id": 1971, "name": "Cabilang Baybay" },
      { "id": 1972, "name": "Lodlod" },
      { "id": 1973, "name": "Nagbalayong" },
      { "id": 1974, "name": "Panilao" }
    ],
    "Orion": [
      { "id": 1975, "name": "Balut" },
      { "id": 1976, "name": "Daan Pare" },
      { "id": 1977, "name": "Santo Niño" },
      { "id": 1978, "name": "Poblacion" },
      { "id": 1979, "name": "San Pedro" }
    ],
    "Pilar": [
      { "id": 1980, "name": "Bagumbayan" },
      { "id": 1981, "name": "Cruz" },
      { "id": 1982, "name": "Limbones" },
      { "id": 1983, "name": "Poblacion" },
      { "id": 1984, "name": "San Pedro" }
    ],
    "Samal": [
      { "id": 1985, "name": "Santo Niño" },
      { "id": 1986, "name": "San Francisco" },
      { "id": 1987, "name": "Cabulalaan" },
      { "id": 1988, "name": "Nagbalayong" }
    ],
    "Abucay": [
      { "id": 1989, "name": "Balubad" },
      { "id": 1990, "name": "Banca" },
      { "id": 1991, "name": "Santo Niño" },
      { "id": 1992, "name": "Malaguino" }
    ],
    "Bagac": [
      { "id": 1993, "name": "Bayanan" },
      { "id": 1994, "name": "Panginay" },
      { "id": 1995, "name": "San Vicente" }
    ],
    "Dinalupihan": [
      { "id": 1996, "name": "San Pedro" },
      { "id": 1997, "name": "Poblacion" },
      { "id": 1998, "name": "Longos" },
      { "id": 1999, "name": "Mariveles" }
    ],
    "Hermosa": [
      { "id": 2000, "name": "San Pedro" },
      { "id": 2001, "name": "Poblacion" },
      { "id": 2002, "name": "Balsik" },
      { "id": 2003, "name": "Pinto" }
    ],
    "Orani": [
      { "id": 2004, "name": "Tenejero" },
      { "id": 2005, "name": "Barangay I" },
      { "id": 2006, "name": "Barangay II" }
    ],
    "Malolos City": [
      { "id": 2007, "name": "Bagumbayan" },
      { "id": 2008, "name": "Longos" },
      { "id": 2009, "name": "Ligas" },
      { "id": 2010, "name": "Pinagbarilan" },
      { "id": 2011, "name": "San Juan" }
    ],
    "Meycauayan City": [
      { "id": 2012, "name": "Ibayo" },
      { "id": 2013, "name": "Lias" },
      { "id": 2014, "name": "Poblacion" },
      { "id": 2015, "name": "Lawang Bato" },
      { "id": 2016, "name": "Saluysoy" }
    ],
    "San Jose del Monte City": [
      { "id": 2017, "name": "Cupang" },
      { "id": 2018, "name": "San Isidro" },
      { "id": 2019, "name": "Minuyan" },
      { "id": 2020, "name": "Santo Niño" },
      { "id": 2021, "name": "Bagumbong" }
    ],
    "Bustos": [
      { "id": 2022, "name": "Bungahan" },
      { "id": 2023, "name": "Lawa" },
      { "id": 2024, "name": "Duhat" },
      { "id": 2025, "name": "Masantol" },
      { "id": 2026, "name": "San Gabriel" }
    ],
    "Calumpit": [
      { "id": 2027, "name": "Barangay I" },
      { "id": 2028, "name": "Barangay II" },
      { "id": 2029, "name": "Longos" },
      { "id": 2030, "name": "Lusacan" }
    ],
    "Guiguinto": [
      { "id": 2031, "name": "Balagtas" },
      { "id": 2032, "name": "Longos" },
      { "id": 2033, "name": "Santol" },
      { "id": 2034, "name": "San Isidro" }
    ],
    "Hagonoy": [
      { "id": 2035, "name": "Santo Niño" },
      { "id": 2036, "name": "Poblacion" },
      { "id": 2037, "name": "Magsaysay" },
      { "id": 2038, "name": "Bambang" }
    ],
    "Balagtas": [
      { "id": 2039, "name": "San Juan" },
      { "id": 2040, "name": "Poblacion" },
      { "id": 2041, "name": "Mabini" }
    ],
    "Bocaue": [
      { "id": 2042, "name": "Duhat" },
      { "id": 2043, "name": "Bungahan" },
      { "id": 2044, "name": "Longos" },
      { "id": 2045, "name": "Bacal" }
    ],
    "Bulakan": [
      { "id": 2046, "name": "San Antonio" },
      { "id": 2047, "name": "Malvar" },
      { "id": 2048, "name": "Dulong Bayan" }
    ],
    "Marilao": [
      { "id": 2049, "name": "Malhacan" },
      { "id": 2050, "name": "Lias" },
      { "id": 2051, "name": "Poblacion" },
      { "id": 2052, "name": "Bucandala" },
      { "id": 2053, "name": "Ibayo" }
    ],
    "Norzagaray": [
      { "id": 2054, "name": "Bigte" },
      { "id": 2055, "name": "Longos" },
      { "id": 2056, "name": "Poblacion" },
      { "id": 2057, "name": "Bancal" },
      { "id": 2058, "name": "Bgy. Wawa" }
    ],
    "Obando": [
      { "id": 2059, "name": "Poblacion" },
      { "id": 2060, "name": "Santo Niño" },
      { "id": 2061, "name": "Tabang" },
      { "id": 2062, "name": "Hagonoy" },
      { "id": 2063, "name": "Bayan" }
    ],
    "Pandi": [
      { "id": 2064, "name": "Poblacion" },
      { "id": 2065, "name": "Bucol" },
      { "id": 2066, "name": "San Isidro" },
      { "id": 2067, "name": "Bagumbayan" }
    ],
    "Paombong": [
      { "id": 2068, "name": "San Juan" },
      { "id": 2069, "name": "Malhacan" },
      { "id": 2070, "name": "Dulong Bayan" },
      { "id": 2071, "name": "San Isidro" }
    ],
    "Plaridel": [
      { "id": 2072, "name": "Bagumbayan" },
      { "id": 2073, "name": "Bungahan" },
      { "id": 2074, "name": "Bayan" },
      { "id": 2075, "name": "Lumbang" }
    ],
    "San Ildefonso": [
      { "id": 2076, "name": "Santo Niño" },
      { "id": 2077, "name": "San Pedro" },
      { "id": 2078, "name": "San Isidro" },
      { "id": 2079, "name": "San Jose" }
    ],
    "San Miguel": [
      { "id": 2080, "name": "Mahayag" },
      { "id": 2081, "name": "Cahambugan" },
      { "id": 2082, "name": "San Ildefonso" },
      { "id": 2083, "name": "Poblacion" }
    ],
    "San Rafael": [
      { "id": 2084, "name": "Bancal" },
      { "id": 2085, "name": "Poblacion" },
      { "id": 2086, "name": "San Jose" },
      { "id": 2087, "name": "San Antonio" }
    ],
    "San Simon": [
      { "id": 2088, "name": "San Isidro" },
      { "id": 2089, "name": "San Juan" },
      { "id": 2090, "name": "Santo Niño" },
      { "id": 2091, "name": "Malibay" }
    ],
    "Santa Maria": [
      { "id": 2092, "name": "Poblacion" },
      { "id": 2093, "name": "San Agustin" },
      { "id": 2094, "name": "Longos" },
      { "id": 2095, "name": "Bungahan" }
    ],
    "Cabanatuan City": [
      { "id": 2096, "name": "Barrio III" },
      { "id": 2097, "name": "Bayanihan" },
      { "id": 2098, "name": "Bitas" },
      { "id": 2099, "name": "Canubing" },
      { "id": 2100, "name": "Del Pilar" }
    ],
    "Gapan City": [
      { "id": 2101, "name": "Bataan" },
      { "id": 2102, "name": "Belen" },
      { "id": 2103, "name": "Dawis" },
      { "id": 2104, "name": "Malasin" },
      { "id": 2105, "name": "Poblacion" }
    ],
    "San Jose City": [
      { "id": 2106, "name": "Cabatuan" },
      { "id": 2107, "name": "Cabayaoasan" },
      { "id": 2108, "name": "Calabidongan" },
      { "id": 2109, "name": "Dibacong" },
      { "id": 2110, "name": "Dikapinisan" }
    ],
    "Aliaga": [
      { "id": 2111, "name": "Cabatangan" },
      { "id": 2112, "name": "Cawayan" },
      { "id": 2113, "name": "Dabubu" },
      { "id": 2114, "name": "Ibaba" }
    ],
    "Bongabon": [
      { "id": 2115, "name": "Bayanan" },
      { "id": 2116, "name": "Ilog" },
      { "id": 2117, "name": "Malinao" },
      { "id": 2118, "name": "San Vicente" }
    ],
    "Cabiao": [
      { "id": 2119, "name": "Bacal" },
      { "id": 2120, "name": "Bungahan" },
      { "id": 2121, "name": "Haguimit" },
      { "id": 2122, "name": "San Isidro" }
    ],
    "Carranglan": [
      { "id": 2123, "name": "Barrio" },
      { "id": 2124, "name": "Bungao" },
      { "id": 2125, "name": "San Agustin" },
      { "id": 2126, "name": "San Juan" }
    ],
    "Cuyapo": [
      { "id": 2127, "name": "Alitaya" },
      { "id": 2128, "name": "Cabangcalan" },
      { "id": 2129, "name": "Nagbalagan" },
      { "id": 2130, "name": "Tayabo" }
    ],
    "General Tinio": [
      { "id": 2131, "name": "Bagumbayan" },
      { "id": 2132, "name": "Del Pilar" },
      { "id": 2133, "name": "San Juan" },
      { "id": 2134, "name": "San Vicente" }
    ],
    "Guimba": [
      { "id": 2135, "name": "Balani" },
      { "id": 2136, "name": "Bayan" },
      { "id": 2137, "name": "Culo" },
      { "id": 2138, "name": "San Jose" }
    ],
    "Jaen": [
      { "id": 2139, "name": "Bubuc" },
      { "id": 2140, "name": "Dike" },
      { "id": 2141, "name": "Kakiputan" },
      { "id": 2142, "name": "Tibag" }
    ],
    "Llanera": [
      { "id": 2143, "name": "Barrio" },
      { "id": 2144, "name": "Buliran" },
      { "id": 2145, "name": "Labney" },
      { "id": 2146, "name": "San Isidro" }
    ],
    "Licab": [
      { "id": 2147, "name": "Dalin" },
      { "id": 2148, "name": "Bancal" },
      { "id": 2149, "name": "Carmen" },
      { "id": 2150, "name": "San Jose" }
    ],
    "Lupao": [
      { "id": 2151, "name": "Batan" },
      { "id": 2152, "name": "Bayabas" },
      { "id": 2153, "name": "Bucao" },
      { "id": 2154, "name": "San Francisco" }
    ],
    "Nampicuan": [
      { "id": 2155, "name": "Bancal" },
      { "id": 2156, "name": "San Isidro" },
      { "id": 2157, "name": "San Juan" },
      { "id": 2158, "name": "San Nicolas" }
    ],
    "Pantabangan": [
      { "id": 2159, "name": "Bagumbayan" },
      { "id": 2160, "name": "Bantug" },
      { "id": 2161, "name": "Kalikid" },
      { "id": 2162, "name": "San Juan" }
    ],
    "Quezon": [
      { "id": 2163, "name": "Bancal" },
      { "id": 2164, "name": "Dulong Bayan" },
      { "id": 2165, "name": "Malico" },
      { "id": 2166, "name": "San Jose" }
    ],
    "Rizal": [
      { "id": 2167, "name": "Bagumbayan" },
      { "id": 2168, "name": "Cahumayan" },
      { "id": 2169, "name": "Dumucaan" },
      { "id": 2170, "name": "San Isidro" }
    ],
    "San Antonio": [
      { "id": 2171, "name": "Balian" },
      { "id": 2172, "name": "San Juan" },
      { "id": 2173, "name": "San Vicente" },
      { "id": 2174, "name": "Santo Niño" }
    ],
    "San Isidro": [
      { "id": 2175, "name": "Cabugao" },
      { "id": 2176, "name": "Casili" },
      { "id": 2177, "name": "Malabago" },
      { "id": 2178, "name": "San Vicente" }
    ],
    "San Leonardo": [
      { "id": 2179, "name": "Bacolor" },
      { "id": 2180, "name": "Bularit" },
      { "id": 2181, "name": "Bungon" },
      { "id": 2182, "name": "San Isidro" }
    ],
    "San Juan": [
      { "id": 2183, "name": "Bungro" },
      { "id": 2184, "name": "San Agustin" },
      { "id": 2185, "name": "San Vicente" },
      { "id": 2186, "name": "San Juan" }
    ],
    "San Nicolas": [
      { "id": 2187, "name": "Bayabas" },
      { "id": 2188, "name": "Bucao" },
      { "id": 2189, "name": "Kabagyan" },
      { "id": 2190, "name": "San Antonio" }
    ],
    "San Rafael": [
      { "id": 2191, "name": "Banaoang" },
      { "id": 2192, "name": "Bagumbayan" },
      { "id": 2193, "name": "San Vicente" },
      { "id": 2194, "name": "Santo Niño" }
    ],
    "Santa Rosa": [
        { "id": 2195, "name": "Belen" },
        { "id": 2196, "name": "Poblacion" },
        { "id": 2197, "name": "San Pablo" }
      ],
      "Santo Domingo": [
        { "id": 2198, "name": "Barrio" },
        { "id": 2199, "name": "Dolores" },
        { "id": 2200, "name": "San Rafael" }
      ],
      "Santo Tomas": [
        { "id": 2201, "name": "Santo Niño" },
        { "id": 2202, "name": "San Ildefonso" },
        { "id": 2203, "name": "Bacubac" }
      ],
      "Talavera": [
        { "id": 2204, "name": "San Isidro" },
        { "id": 2205, "name": "Bacubac" },
        { "id": 2206, "name": "San Vicente" }
      ],
      "Talugtug": [
        { "id": 2207, "name": "Bahay Pare" },
        { "id": 2208, "name": "San Juan" },
        { "id": 2209, "name": "Barrio" }
      ],
      "Zaragoza": [
        { "id": 2210, "name": "San Pedro" },
        { "id": 2211, "name": "Luguin" },
        { "id": 2212, "name": "Santo Niño" }
      ],
      "San Fernando City": [
      { "id": 2220, "name": "San Agustin" },
      { "id": 2221, "name": "San Isidro" },
      { "id": 2222, "name": "San Juan" },
      { "id": 2223, "name": "San Pedro" },
      { "id": 2224, "name": "San Vicente" },
      { "id": 2225, "name": "San Miguel" },
      { "id": 2226, "name": "San Matias" },
      { "id": 2227, "name": "San Fabian" }
    ],
    "Angeles City": [
      { "id": 2228, "name": "Amsic" },
      { "id": 2229, "name": "Anunas" },
      { "id": 2230, "name": "Balibago" },
      { "id": 2231, "name": "Cuayan" },
      { "id": 2232, "name": "Dau" },
      { "id": 2233, "name": "Malabanias" },
      { "id": 2234, "name": "Pampang" },
      { "id": 2235, "name": "Pulungbulu" }
    ],
    "Mabalacat City": [
      { "id": 2236, "name": "Bical" },
      { "id": 2237, "name": "Burol" },
      { "id": 2238, "name": "Capalangan" },
      { "id": 2239, "name": "Cutcut" },
      { "id": 2240, "name": "Dalayap" },
      { "id": 2241, "name": "Dau" },
      { "id": 2242, "name": "Mabiga" },
      { "id": 2243, "name": "Mabalacat" }
    ],
    "Apalit": [
      { "id": 2244, "name": "Cupang" },
      { "id": 2245, "name": "Colgante" },
      { "id": 2246, "name": "Longos" },
      { "id": 2247, "name": "Santo Niño" },
      { "id": 2248, "name": "San Juan" }
    ],
    "Bacolor": [
      { "id": 2249, "name": "Dela Paz Norte" },
      { "id": 2250, "name": "Dela Paz Sur" },
      { "id": 2251, "name": "Lusung" },
      { "id": 2252, "name": "Bical" }
    ],
    "Candaba": [
      { "id": 2253, "name": "Cabalantian" },
      { "id": 2254, "name": "Bical" },
      { "id": 2255, "name": "Dila" },
      { "id": 2256, "name": "San Antonio" }
    ],
    "Floridablanca": [
      { "id": 2257, "name": "San Juan" },
      { "id": 2258, "name": "Del Rosario" },
      { "id": 2259, "name": "Poblation" }
    ],
    "Guagua": [
      { "id": 2260, "name": "Bulan" },
      { "id": 2261, "name": "Burgos" },
      { "id": 2262, "name": "Lilian" },
      { "id": 2263, "name": "Poblacion" }
    ],
    "Lubao": [
      { "id": 2264, "name": "Balsik" },
      { "id": 2265, "name": "San Esteban" },
      { "id": 2266, "name": "San Felipe" }
    ],
    "Macabebe": [
      { "id": 2267, "name": "Santo Niño" },
      { "id": 2268, "name": "Balsik" },
      { "id": 2269, "name": "San Antonio" }
    ],
    "Magalang": [
      { "id": 2270, "name": "San Nicolas" },
      { "id": 2271, "name": "San Isidro" },
      { "id": 2272, "name": "Poblacion" }
    ],
    "Minalin": [
      { "id": 2273, "name": "Bical" },
      { "id": 2274, "name": "Dampulan" },
      { "id": 2275, "name": "Poblacion" }
    ],
    "Porac": [
      { "id": 2276, "name": "Bucal" },
      { "id": 2277, "name": "Bataan" },
      { "id": 2278, "name": "San Antonio" }
    ],
    "San Luis": [
      { "id": 2279, "name": "San Juan" },
      { "id": 2280, "name": "Poblacion" },
      { "id": 2281, "name": "Dila" }
    ],
    "San Simon": [
      { "id": 2282, "name": "San Juan" },
      { "id": 2283, "name": "San Pedro" }
    ],
    "Santa Ana": [
      { "id": 2284, "name": "Santo Niño" },
      { "id": 2285, "name": "San Rafael" }
    ],
    "Santa Rita": [
      { "id": 2286, "name": "San Pedro" },
      { "id": 2287, "name": "Santo Niño" }
    ],
    "Santa Teresita": [
      { "id": 2288, "name": "San Vicente" },
      { "id": 2289, "name": "Santa Cruz" }
    ],
    "Santo Tomas": [
      { "id": 2290, "name": "Santo Niño" },
      { "id": 2291, "name": "San Pablo" }
    ],
    "Tarlac City": [
      { "id": 2292, "name": "San Sebastian" },
      { "id": 2293, "name": "San Vicente" },
      { "id": 2294, "name": "Poblacion" },
      { "id": 2295, "name": "San Jose" },
      { "id": 2296, "name": "San Rafael" },
      { "id": 2297, "name": "Lodlod" },
      { "id": 2298, "name": "Balite" },
      { "id": 2299, "name": "Longos" }
    ],
    "Anao": [
      { "id": 2300, "name": "Poblacion" },
      { "id": 2301, "name": "San Juan" },
      { "id": 2302, "name": "San Luis" }
    ],
    "Bamban": [
      { "id": 2303, "name": "San Vicente" },
      { "id": 2304, "name": "San Isidro" },
      { "id": 2305, "name": "Poblacion" }
    ],
    "Concepcion": [
      { "id": 2306, "name": "San Juan" },
      { "id": 2307, "name": "Santo Niño" },
      { "id": 2308, "name": "Poblacion" }
    ],
    "Gerona": [
      { "id": 2309, "name": "San Nicolas" },
      { "id": 2310, "name": "Santo Niño" },
      { "id": 2311, "name": "Poblacion" }
    ],
    "La Paz": [
      { "id": 2312, "name": "San Bartolome" },
      { "id": 2313, "name": "Poblacion" },
      { "id": 2314, "name": "San Agustin" }
    ],
    "Mayantoc": [
      { "id": 2315, "name": "Poblacion" },
      { "id": 2316, "name": "San Rafael" },
      { "id": 2317, "name": "San Vicente" }
    ],
    "Moncada": [
      { "id": 2318, "name": "Poblacion" },
      { "id": 2319, "name": "San Juan" },
      { "id": 2320, "name": "San Antonio" }
    ],
    "Paniqui": [
      { "id": 2321, "name": "San Felipe" },
      { "id": 2322, "name": "San Isidro" },
      { "id": 2323, "name": "Poblacion" }
    ],
    "Pura": [
      { "id": 2324, "name": "Poblacion" },
      { "id": 2325, "name": "San Vicente" },
      { "id": 2326, "name": "San Pablo" }
    ],
    "Ramos": [
      { "id": 2327, "name": "San Jose" },
      { "id": 2328, "name": "San Isidro" },
      { "id": 2329, "name": "Poblacion" }
    ],
    "San Clemente": [
      { "id": 2330, "name": "Poblacion" },
      { "id": 2331, "name": "San Juan" },
      { "id": 2332, "name": "San Isidro" }
    ],
    "San Jose": [
      { "id": 2333, "name": "Poblacion" },
      { "id": 2334, "name": "San Pedro" },
      { "id": 2335, "name": "San Vicente" }
    ],
    "San Manuel": [
      { "id": 2336, "name": "Poblacion" },
      { "id": 2337, "name": "San Isidro" },
      { "id": 2338, "name": "San Rafael" }
    ],
    "San Miguel": [
      { "id": 2339, "name": "Poblacion" },
      { "id": 2340, "name": "San Juan" },
      { "id": 2341, "name": "San Isidro" }
    ],
    "Santa Ignacia": [
      { "id": 2342, "name": "Poblacion" },
      { "id": 2343, "name": "San Juan" },
      { "id": 2344, "name": "San Vicente" }
    ],
    "Santa Lucia": [
      { "id": 2345, "name": "Poblacion" },
      { "id": 2346, "name": "San Vicente" },
      { "id": 2347, "name": "San Juan" }
    ],
    "Santa Rosa": [
      { "id": 2348, "name": "Poblacion" },
      { "id": 2349, "name": "San Vicente" },
      { "id": 2350, "name": "San Rafael" }
    ],
    "Victoria": [
      { "id": 2351, "name": "Poblacion" },
      { "id": 2352, "name": "San Juan" },
      { "id": 2353, "name": "San Vicente" }
    ],
    "Olongapo City": [
      { "id": 2354, "name": "Barangay 1" },
      { "id": 2355, "name": "Barangay 2" },
      { "id": 2356, "name": "Barangay 3" },
      { "id": 2357, "name": "Barangay 4" },
      { "id": 2358, "name": "Barangay 5" },
      { "id": 2359, "name": "Barangay 6" }
    ],
    "Iba": [
      { "id": 2360, "name": "Poblacion" },
      { "id": 2361, "name": "San Juan" },
      { "id": 2362, "name": "San Pedro" }
    ],
    "Botolan": [
      { "id": 2363, "name": "San Isidro" },
      { "id": 2364, "name": "San Antonio" },
      { "id": 2365, "name": "Poblacion" }
    ],
    "Candelaria": [
      { "id": 2366, "name": "San Vicente" },
      { "id": 2367, "name": "San Pablo" },
      { "id": 2368, "name": "Poblacion" }
    ],
    "Castillejos": [
      { "id": 2369, "name": "San Isidro" },
      { "id": 2370, "name": "San Miguel" },
      { "id": 2371, "name": "Poblacion" }
    ],
    "Masinloc": [
      { "id": 2372, "name": "San Juan" },
      { "id": 2373, "name": "San Antonio" },
      { "id": 2374, "name": "Poblacion" }
    ],
    "Palauig": [
      { "id": 2375, "name": "San Vicente" },
      { "id": 2376, "name": "San Fernando" },
      { "id": 2377, "name": "Poblacion" }
    ],
    "San Antonio": [
      { "id": 2378, "name": "San Isidro" },
      { "id": 2379, "name": "San Pablo" },
      { "id": 2380, "name": "Poblacion" }
    ],
    "San Felipe": [
      { "id": 2381, "name": "San Juan" },
      { "id": 2382, "name": "San Isidro" },
      { "id": 2383, "name": "Poblacion" }
    ],
    "San Marcelino": [
      { "id": 2384, "name": "San Vicente" },
      { "id": 2385, "name": "San Pablo" },
      { "id": 2386, "name": "Poblacion" }
    ],
    "San Narciso": [
      { "id": 2387, "name": "San Antonio" },
      { "id": 2388, "name": "San Isidro" },
      { "id": 2389, "name": "Poblacion" }
    ],
    "San Pablo": [
      { "id": 2390, "name": "San Juan" },
      { "id": 2391, "name": "San Vicente" },
      { "id": 2392, "name": "Poblacion" }
    ],
    "Santa Cruz": [
      { "id": 2393, "name": "Poblacion" },
      { "id": 2394, "name": "San Isidro" },
      { "id": 2395, "name": "San Antonio" }
    ],
    "Santa Margarita": [
      { "id": 2396, "name": "San Juan" },
      { "id": 2397, "name": "San Vicente" },
      { "id": 2398, "name": "Poblacion" }
    ],
    "Santa Rita": [
      { "id": 2399, "name": "San Isidro" },
      { "id": 2400, "name": "San Juan" },
      { "id": 2401, "name": "Poblacion" }
    ],
    "Batangas City": [
      { "id": 2402, "name": "Alangilan" },
      { "id": 2403, "name": "Apatot" },
      { "id": 2404, "name": "Bagumbayan" },
      { "id": 2405, "name": "Balagtas" },
      { "id": 2406, "name": "Balete" }
    ],
    "Lipa City": [
      { "id": 2407, "name": "Antipolo" },
      { "id": 2408, "name": "Balintawak" },
      { "id": 2409, "name": "Banay-Banay" },
      { "id": 2410, "name": "Bayang Luma" },
      { "id": 2411, "name": "Bucal" }
    ],
    "Tanauan City": [
      { "id": 2412, "name": "Alangilan" },
      { "id": 2413, "name": "Banjo West" },
      { "id": 2414, "name": "Banjo East" },
      { "id": 2415, "name": "Bucao" },
      { "id": 2416, "name": "Caysio" }
    ],

    "San Jose": [
      { "id": 2421, "name": "Barangay 1" },
      { "id": 2422, "name": "Barangay 2" },
      { "id": 2423, "name": "Barangay 3" }
    ],
    "Taal": [
      { "id": 2424, "name": "Caysio" },
      { "id": 2425, "name": "Manalo" },
      { "id": 2426, "name": "San Juan" }
    ],
    "Santa Teresita": [
      { "id": 2427, "name": "Poblacion" },
      { "id": 2428, "name": "San Vicente" },
      { "id": 2429, "name": "San Ildefonso" }
    ],
    "San Juan": [
      { "id": 2430, "name": "Bacungan" },
      { "id": 2431, "name": "San Juan" },
      { "id": 2432, "name": "San Pedro" }
    ],
    "Cuenca": [
      { "id": 2433, "name": "Poblacion" },
      { "id": 2434, "name": "San Antonio" },
      { "id": 2435, "name": "San Jose" }
    ],
    "Ibaan": [
      { "id": 2436, "name": "Barangay 1" },
      { "id": 2437, "name": "Barangay 2" },
      { "id": 2438, "name": "Barangay 3" }
    ],
    "Laurel": [
      { "id": 2439, "name": "San Carlos" },
      { "id": 2440, "name": "San Isidro" },
      { "id": 2441, "name": "Poblacion" }
    ],
    "Lemery": [
      { "id": 2442, "name": "Barangay 1" },
      { "id": 2443, "name": "Barangay 2" },
      { "id": 2444, "name": "Barangay 3" }
    ],
    "Mataasnakahoy": [
      { "id": 2445, "name": "Poblacion" },
      { "id": 2446, "name": "San Jose" },
      { "id": 2447, "name": "San Juan" }
    ],
    "San Nicolas": [
      { "id": 2448, "name": "San Antonio" },
      { "id": 2449, "name": "San Ildefonso" }
    ],
    "San Pascual": [
      { "id": 2450, "name": "San Isidro" },
      { "id": 2451, "name": "Poblacion" },
      { "id": 2452, "name": "San Pedro" }
    ],
    "Santa Teresa": [
      { "id": 2453, "name": "San Isidro" },
      { "id": 2454, "name": "Poblacion" }
    ],
    "Cavite City": [
      { "id": 1001, "name": "Barangay 1" },
      { "id": 1002, "name": "Barangay 2" },
      { "id": 1003, "name": "Barangay 3" },
      { "id": 1004, "name": "Barangay 4" },
      { "id": 1005, "name": "Barangay 5" }
    ],
    "Tagaytay City": [
      { "id": 1006, "name": "Tagaytay Proper" },
      { "id": 1007, "name": "Dahilayan" },
      { "id": 1008, "name": "San Jose" },
      { "id": 1009, "name": "San Juan" },
      { "id": 1010, "name": "San Rafael" }
    ],
    "Dasmariñas City": [
      { "id": 1011, "name": "San Agustin" },
      { "id": 1012, "name": "San Antonio" },
      { "id": 1013, "name": "San Benito" },
      { "id": 1014, "name": "San Isidro" },
      { "id": 1015, "name": "San Juan" }
    ],
    "Bacoor City": [
      { "id": 1016, "name": "Alima" },
      { "id": 1017, "name": "Bacoor Proper" },
      { "id": 1018, "name": "Salinas" },
      { "id": 1019, "name": "San Nicolas" },
      { "id": 1020, "name": "San Juan" }
    ],
    "Imus City": [
      { "id": 1021, "name": "Anabu" },
      { "id": 1022, "name": "Burol" },
      { "id": 1023, "name": "Malagasang" },
      { "id": 1024, "name": "Poblacion" },
      { "id": 1025, "name": "San Mateo" }
    ],
    "Kawit": [
      { "id": 1026, "name": "Barangay 1" },
      { "id": 1027, "name": "Barangay 2" },
      { "id": 1028, "name": "Barangay 3" },
      { "id": 1029, "name": "Barangay 4" }
    ],
    "Noveleta": [
      { "id": 1030, "name": "Barangay 1" },
      { "id": 1031, "name": "Barangay 2" },
      { "id": 1032, "name": "Barangay 3" },
      { "id": 1033, "name": "Barangay 4" }
    ],
    "Rosario": [
      { "id": 1034, "name": "Bagumbayan" },
      { "id": 1035, "name": "Dulong Bayan" },
      { "id": 1036, "name": "Poblacion" },
      { "id": 1037, "name": "San Juan" }
    ],
    "General Trias": [
      { "id": 1038, "name": "Bancal" },
      { "id": 1039, "name": "Herran" },
      { "id": 1040, "name": "San Francisco" },
      { "id": 1041, "name": "San Isidro" }
    ],
    "Tanza": [
      { "id": 1042, "name": "Bayanan" },
      { "id": 1043, "name": "Mataas na Lupa" },
      { "id": 1044, "name": "San Jose" },
      { "id": 1045, "name": "San Juan" }
    ],
    "Naic": [
      { "id": 1046, "name": "Barangay 1" },
      { "id": 1047, "name": "Barangay 2" },
      { "id": 1048, "name": "Barangay 3" },
      { "id": 1049, "name": "Barangay 4" }
    ],
    "Magallanes": [
      { "id": 1050, "name": "Barangay 1" },
      { "id": 1051, "name": "Barangay 2" },
      { "id": 1052, "name": "Barangay 3" }
    ],
    "Maragondon": [
      { "id": 1053, "name": "Barangay 1" },
      { "id": 1054, "name": "Barangay 2" },
      { "id": 1055, "name": "Barangay 3" }
    ],
    "Mendez": [
      { "id": 1056, "name": "Barangay 1" },
      { "id": 1057, "name": "Barangay 2" },
      { "id": 1058, "name": "Barangay 3" }
    ],
    "Silang": [
      { "id": 1059, "name": "Barangay 1" },
      { "id": 1060, "name": "Barangay 2" },
      { "id": 1061, "name": "Barangay 3" }
    ],
    "Alfonso": [
      { "id": 1062, "name": "Barangay 1" },
      { "id": 1063, "name": "Barangay 2" },
      { "id": 1064, "name": "Barangay 3" }
    ],
    "Amadeo": [
      { "id": 1065, "name": "Barangay 1" },
      { "id": 1066, "name": "Barangay 2" },
      { "id": 1067, "name": "Barangay 3" }
    ],
    "General Emilio Aguinaldo": [
      { "id": 1068, "name": "Barangay 1" },
      { "id": 1069, "name": "Barangay 2" },
      { "id": 1070, "name": "Barangay 3" }
    ],
    'Dipolog City': [
    { "id": 1877, "name": "Barra" },
    { "id": 1878, "name": "Biasong" },
    { "id": 1879, "name": "Central" },
    { "id": 1880, "name": "Cogon" },
    { "id": 1881, "name": "Diwan" },
    { "id": 1882, "name": "Galas" },
    { "id": 1883, "name": "Gulayon" },
    { "id": 1884, "name": "Lawa-an" },
    { "id": 1885, "name": "Minaog" },
    { "id": 1886, "name": "Olingan" },
    { "id": 1887, "name": "San Jose" },
    { "id": 1888, "name": "Sicayab" },
    { "id": 1889, "name": "Sinaman" },
    { "id": 1890, "name": "Sta. Filomena" },
    { "id": 1891, "name": "Sta. Isabel" },
    { "id": 1892, "name": "Sta. Maria" },
    { "id": 1893, "name": "Sulangon" },
    { "id": 1894, "name": "Turno" }
],
'Dapitan City': [
    { "id": 1895, "name": "Banonong" },
    { "id": 1896, "name": "Burgos" },
    { "id": 1897, "name": "Canlucani" },
    { "id": 1898, "name": "Carang" },
    { "id": 1899, "name": "Dampalan" },
    { "id": 1900, "name": "Ilaya" },
    { "id": 1901, "name": "Larayan" },
    { "id": 1902, "name": "Owaon" },
    { "id": 1903, "name": "Polo" },
    { "id": 1904, "name": "Potol" },
    { "id": 1905, "name": "San Francisco" },
    { "id": 1906, "name": "San Nicolas" },
    { "id": 1907, "name": "Sicayab Bucana" },
    { "id": 1908, "name": "Sulangon" },
    { "id": 1909, "name": "Taguilon" }
],
'Polanco': [
    { "id": 1910, "name": "Anastacio" },
    { "id": 1911, "name": "Bandera" },
    { "id": 1912, "name": "Bethlehem" },
    { "id": 1913, "name": "Gumahan" },
    { "id": 1914, "name": "Kinangay Sur" },
    { "id": 1915, "name": "Letapan" },
    { "id": 1916, "name": "Macleodes" },
    { "id": 1917, "name": "Milad" },
    { "id": 1918, "name": "Poblacion North" },
    { "id": 1919, "name": "Sianib" }
],
'Sergio Osmeña Sr.': [
    { "id": 1920, "name": "Balatakan" },
    { "id": 1921, "name": "Calabayan" },
    { "id": 1922, "name": "Kinuman Norte" },
    { "id": 1923, "name": "Labrador" },
    { "id": 1924, "name": "Luzvilla" },
    { "id": 1925, "name": "Sebod" },
    { "id": 1926, "name": "Venus" }
],
'Salug': [
    { "id": 1927, "name": "Bacong" },
    { "id": 1928, "name": "Binoni" },
    { "id": 1929, "name": "Caracol" },
    { "id": 1930, "name": "Ecuan" },
    { "id": 1931, "name": "Pukay" },
    { "id": 1932, "name": "Tapalan" },
    { "id": 1933, "name": "San Miguel" }
],
'Pagadian City': [
    { "id": 1934, "name": "Alegria" },
    { "id": 1935, "name": "Balangasan" },
    { "id": 1936, "name": "Balanagan" },
    { "id": 1937, "name": "Baloyboan" },
    { "id": 1938, "name": "Buenavista" },
    { "id": 1939, "name": "Dao" },
    { "id": 1940, "name": "Ditoray" },
    { "id": 1941, "name": "Gatas" },
    { "id": 1942, "name": "Lala" },
    { "id": 1943, "name": "Muricay" },
    { "id": 1944, "name": "Napolan" },
    { "id": 1945, "name": "San Jose" },
    { "id": 1946, "name": "Santa Lucia" },
    { "id": 1947, "name": "Santa Maria" },
    { "id": 1948, "name": "Santiago" },
    { "id": 1949, "name": "Tiguma" },
    { "id": 1950, "name": "Tuburan" }
],
'Molave': [
    { "id": 1951, "name": "Blancia" },
    { "id": 1952, "name": "Culo" },
    { "id": 1953, "name": "Dipolo" },
    { "id": 1954, "name": "Gonosan" },
    { "id": 1955, "name": "Madasigon" },
    { "id": 1956, "name": "Maloloy-on" },
    { "id": 1957, "name": "Parasan" },
    { "id": 1958, "name": "Pinalim" },
    { "id": 1959, "name": "Simata" },
    { "id": 1960, "name": "Silangit" },
    { "id": 1961, "name": "Sudlon" }
],
'Alicia': [
    { "id": 1962, "name": "Bagongbayan" },
    { "id": 1963, "name": "Concepcion" },
    { "id": 1964, "name": "Del Monte" },
    { "id": 1965, "name": "Guinabot" },
    { "id": 1966, "name": "Napo" },
    { "id": 1967, "name": "Payag" },
    { "id": 1968, "name": "Sibugay" },
    { "id": 1969, "name": "Tomitom" }
],
'Guipos': [
    { "id": 1970, "name": "Baguitan" },
    { "id": 1971, "name": "Datagan" },
    { "id": 1972, "name": "Lantungan" },
    { "id": 1973, "name": "Magting" },
    { "id": 1974, "name": "Poblacion" },
    { "id": 1975, "name": "Sikatuna" },
    { "id": 1976, "name": "Singclot" }
],
'Ipil': [
    { "id": 1821, "name": "Bacalan" },
    { "id": 1822, "name": "Bualan" },
    { "id": 1823, "name": "Dacal" },
    { "id": 1824, "name": "Domandan" },
    { "id": 1825, "name": "Guituan" },
    { "id": 1826, "name": "Lower Taway" },
    { "id": 1827, "name": "Magsaysay" },
    { "id": 1828, "name": "Pangi" },
    { "id": 1829, "name": "Sanito" },
    { "id": 1830, "name": "Tiayon" },
    { "id": 1831, "name": "Upper Taway" }
],
'Alicia': [
    { "id": 1832, "name": "Bagong Oslob" },
    { "id": 1833, "name": "Concepcion" },
    { "id": 1834, "name": "Dawa-Dawa" },
    { "id": 1835, "name": "La Paz" },
    { "id": 1836, "name": "Sampoli" }
],
'Buug': [
    { "id": 1837, "name": "Bawang" },
    { "id": 1838, "name": "Labrador" },
    { "id": 1839, "name": "Pamintayan" },
    { "id": 1840, "name": "Poblacion" },
    { "id": 1841, "name": "Santa Cruz" }
],
'Diplahan': [
    { "id": 1842, "name": "Butong" },
    { "id": 1843, "name": "Camunga" },
    { "id": 1844, "name": "Mejo" },
    { "id": 1845, "name": "San Isidro" },
    { "id": 1846, "name": "Songcuya" }
],
'Imelda': [
    { "id": 1847, "name": "Balugo" },
    { "id": 1848, "name": "Bengke" },
    { "id": 1849, "name": "Dimalinao" },
    { "id": 1850, "name": "La Libertad" },
    { "id": 1851, "name": "Lower Baluran" }
],
'Kabasalan': [
    { "id": 1852, "name": "Concepcion" },
    { "id": 1853, "name": "Little Baguio" },
    { "id": 1854, "name": "Poblacion" },
    { "id": 1855, "name": "Salipyasin" },
    { "id": 1856, "name": "Tampilisan" }
],
'Mabuhay': [
    { "id": 1857, "name": "Baganipay" },
    { "id": 1858, "name": "Catipan" },
    { "id": 1859, "name": "Poblacion" },
    { "id": 1860, "name": "Santo Niño" }
],
'Malangas': [
    { "id": 1861, "name": "La Dicha" },
    { "id": 1862, "name": "Lisap" },
    { "id": 1863, "name": "Miasan" },
    { "id": 1864, "name": "Sinusayan" }
],
'Naga': [
    { "id": 1865, "name": "Bacong" },
    { "id": 1866, "name": "Bayog" },
    { "id": 1867, "name": "Bulao" },
    { "id": 1868, "name": "Lower Talamimi" },
    { "id": 1869, "name": "Poblacion" }
],
'Olutanga': [
    { "id": 1870, "name": "Calais" },
    { "id": 1871, "name": "Gaguil" },
    { "id": 1872, "name": "Libertad" },
    { "id": 1873, "name": "Paril" }
],
'Payao': [
    { "id": 1874, "name": "Bulawan" },
    { "id": 1875, "name": "Guinoman" },
    { "id": 1876, "name": "Katipunan" },
    { "id": 1877, "name": "Kima" }
],
'Roseller T. Lim': [
    { "id": 1878, "name": "Canunan" },
    { "id": 1879, "name": "Gatas" },
    { "id": 1880, "name": "Katipunan" },
    { "id": 1881, "name": "Poblacion" }
],
'Siay': [
    { "id": 1882, "name": "Candis" },
    { "id": 1883, "name": "Dalangin" },
    { "id": 1884, "name": "Dumalian" },
    { "id": 1885, "name": "Lood" }
],
'Talusan': [
    { "id": 1886, "name": "Aurora" },
    { "id": 1887, "name": "Maton-og" },
    { "id": 1888, "name": "Poblacion" },
    { "id": 1889, "name": "Samonte" }
],
'Titay': [
    { "id": 1890, "name": "Bangco" },
    { "id": 1891, "name": "Concepcion" },
    { "id": 1892, "name": "Mambisig" },
    { "id": 1893, "name": "Poblacion" }
],
'Tungawan': [
    { "id": 1894, "name": "Banale" },
    { "id": 1895, "name": "Libertad" },
    { "id": 1896, "name": "Longilog" },
    { "id": 1897, "name": "Lumbia" }
],
'Malaybalay City': [
    { "id": 1901, "name": "Casisang" },
    { "id": 1902, "name": "Dahilayan" },
    { "id": 1903, "name": "Dalwangan" },
    { "id": 1904, "name": "Imbayao" },
    { "id": 1905, "name": "Labangon" },
    { "id": 1906, "name": "Lumbayao" },
    { "id": 1907, "name": "Minalungao" },
    { "id": 1908, "name": "Poblacion" },
    { "id": 1909, "name": "San Jose" },
    { "id": 1910, "name": "San Isidro" }
],
'Valencia City': [
    { "id": 1911, "name": "Bagontaas" },
    { "id": 1912, "name": "Banlag" },
    { "id": 1913, "name": "Bantuan" },
    { "id": 1914, "name": "Bugas" },
    { "id": 1915, "name": "Dalwangan" },
    { "id": 1916, "name": "Dahilayan" },
    { "id": 1917, "name": "Kilad-an" },
    { "id": 1918, "name": "Labangon" },
    { "id": 1919, "name": "Lumbayao" },
    { "id": 1920, "name": "Poblacion" }
],
'Maramag': [
    { "id": 1921, "name": "Bae" },
    { "id": 1922, "name": "Bugcaon" },
    { "id": 1923, "name": "Himbalagon" },
    { "id": 1924, "name": "Lantapan" },
    { "id": 1925, "name": "Lumbayao" },
    { "id": 1926, "name": "Mabuhay" },
    { "id": 1927, "name": "Magsaysay" },
    { "id": 1928, "name": "Manolo Fortich" }
],
'Manolo Fortich': [
    { "id": 1929, "name": "Aglayan" },
    { "id": 1930, "name": "Bae" },
    { "id": 1931, "name": "Bagontaas" },
    { "id": 1932, "name": "Dalwangan" },
    { "id": 1933, "name": "Imbayao" },
    { "id": 1934, "name": "Kiling" },
    { "id": 1935, "name": "Lumbayao" }
],
'Cabanglasan': [
    { "id": 1936, "name": "Poblacion" },
    { "id": 1937, "name": "Labangan" },
    { "id": 1938, "name": "Pangabuan" },
    { "id": 1939, "name": "San Isidro" }
],
'Mambajao': [
    { "id": 1940, "name": "Anilao" },
    { "id": 1941, "name": "Bagumbayan" },
    { "id": 1942, "name": "Balete" },
    { "id": 1943, "name": "Bato" },
    { "id": 1944, "name": "Benoni" },
    { "id": 1945, "name": "Cabuan" },
    { "id": 1946, "name": "Catarman" },
    { "id": 1947, "name": "Catugbacan" }
],
'Catarman': [
    { "id": 1948, "name": "Antipolo" },
    { "id": 1949, "name": "Bancao-Bancao" },
    { "id": 1950, "name": "Banuyo" },
    { "id": 1951, "name": "Barag" },
    { "id": 1952, "name": "Cabilogan" }
],
'Guinsiliban': [
    { "id": 1953, "name": "Guinsiliban" },
    { "id": 1954, "name": "Luknayan" }
],
'Sagay': [
    { "id": 1955, "name": "Balaring" },
    { "id": 1956, "name": "Binalbagan" },
    { "id": 1957, "name": "Bulod" },
    { "id": 1958, "name": "Daga" },
    { "id": 1959, "name": "Napacao" },
    { "id": 1960, "name": "Poblacion" }
],
'Mahinog': [
    { "id": 1961, "name": "Bonbon" },
    { "id": 1962, "name": "Cahibunan" },
    { "id": 1963, "name": "Catumbalon" },
    { "id": 1964, "name": "Central" },
    { "id": 1965, "name": "Jinalinan" }
],
'Iligan City': [
    { "id": 1966, "name": "Poblacion" },
    { "id": 1967, "name": "Bacolod" },
    { "id": 1968, "name": "Bagumbayan" },
    { "id": 1969, "name": "Burot" },
    { "id": 1970, "name": "Santo Niño" }
],
'Tangub City': [
    { "id": 1971, "name": "Bagumbayan" },
    { "id": 1972, "name": "Dagsian" },
    { "id": 1973, "name": "Dukay" },
    { "id": 1974, "name": "Lumbayao" },
    { "id": 1975, "name": "Poblacion" }
],
'Kapatagan': [
    { "id": 1976, "name": "Bagumbayan" },
    { "id": 1977, "name": "Bugsukan" },
    { "id": 1978, "name": "Dahilayan" },
    { "id": 1979, "name": "Kapatagan" },
    { "id": 1980, "name": "Poblacion" }
],
'Kauswagan': [
    { "id": 1981, "name": "Bagumbayan" },
    { "id": 1982, "name": "Dugyanan" },
    { "id": 1983, "name": "Mangat" },
    { "id": 1984, "name": "Poblacion" }
],
'Linamon': [
    { "id": 1985, "name": "Dacol" },
    { "id": 1986, "name": "Baluno" },
    { "id": 1987, "name": "Magtang" },
    { "id": 1988, "name": "San Agustin" }
],
'Oroquieta City': [
    { "id": 1989, "name": "Danao" },
    { "id": 1990, "name": "Santo Niño" },
    { "id": 1991, "name": "Lumbang" },
    { "id": 1992, "name": "Lumbang" }
],
'Ozamiz City': [
    { "id": 1993, "name": "Barangay 1" },
    { "id": 1994, "name": "Barangay 2" },
    { "id": 1995, "name": "Barangay 3" },
    { "id": 1996, "name": "Barangay 4" }
],
'Tudela': [
    { "id": 1997, "name": "Tudela" }
],
'Jimenez': [
    { "id": 1998, "name": "Bacungan" },
    { "id": 1999, "name": "Binuni" },
    { "id": 2000, "name": "Poblacion" }
],
'Plaridel': [
    { "id": 2001, "name": "Dinaigan" },
    { "id": 2002, "name": "Dianalagan" }
],
'Gingoog City': [
    { "id": 2003, "name": "Bal-ason" },
    { "id": 2004, "name": "Bantug" },
    { "id": 2005, "name": "Baño" },
    { "id": 2006, "name": "Dumanjog" },
    { "id": 2007, "name": "Santo Niño" }
],
'Jasaan': [
    { "id": 2008, "name": "Barangay 1" },
    { "id": 2009, "name": "Barangay 2" },
    { "id": 2010, "name": "Barangay 3" }
],
'Gitagum': [
    { "id": 2011, "name": "Bagtic" },
    { "id": 2012, "name": "Baclayan" }
],
'Villanueva': [
    { "id": 2013, "name": "Awihao" },
    { "id": 2014, "name": "Maglipay" }
],
'Monkayo': [
    { "id": 2015, "name": "Awihao" },
    { "id": 2016, "name": "Maglipay" },
    { "id": 2017, "name": "Malambo" },
    { "id": 2018, "name": "Poblacion" },
    { "id": 2019, "name": "Lower Baño" },
    { "id": 2020, "name": "Upper Baño" },
    { "id": 2021, "name": "Diwata" },
    { "id": 2022, "name": "Mt. Diwata" }
],

'Nabunturan': [
    { "id": 2023, "name": "Anislagan" },
    { "id": 2024, "name": "Antequera" },
    { "id": 2025, "name": "Basak" },
    { "id": 2026, "name": "Bayabas" },
    { "id": 2027, "name": "Bukal" },
    { "id": 2028, "name": "Cabacungan" },
    { "id": 2029, "name": "Cabidianan" },
    { "id": 2030, "name": "Katipunan" },
    { "id": 2031, "name": "Libasan" },
    { "id": 2032, "name": "Linda" },
    { "id": 2033, "name": "Magading" },
    { "id": 2034, "name": "Magsaysay" },
    { "id": 2035, "name": "Mainit" },
    { "id": 2036, "name": "Manat" },
    { "id": 2037, "name": "Matilo" },
    { "id": 2038, "name": "Mipangi" },
    { "id": 2039, "name": "New Dauis" },
    { "id": 2040, "name": "New Sibonga" },
    { "id": 2041, "name": "Ogao" },
    { "id": 2042, "name": "Poblacion" },
    { "id": 2043, "name": "San Isidro" },
    { "id": 2044, "name": "San Roque" },
    { "id": 2045, "name": "San Vicente" },
    { "id": 2046, "name": "Santa Maria" },
    { "id": 2047, "name": "Santo Niño" },
    { "id": 2048, "name": "Sasa" },
    { "id": 2049, "name": "Tagnocon" }
],

'Pantukan': [
    { "id": 2050, "name": "Alagatan" },
    { "id": 2051, "name": "Binondo" },
    { "id": 2052, "name": "Datu Salumay" },
    { "id": 2053, "name": "Don Martin Marundan" },
    { "id": 2054, "name": "Magsaysay" },
    { "id": 2055, "name": "Poblacion" },
    { "id": 2056, "name": "Pundaguitan" },
    { "id": 2057, "name": "San Isidro" },
    { "id": 2058, "name": "San Jose" },
    { "id": 2059, "name": "Wakwak" }
],

'New Bataan': [
    { "id": 2060, "name": "Andap" },
    { "id": 2061, "name": "Bañgo" },
    { "id": 2062, "name": "Banlag" },
    { "id": 2063, "name": "New Albay" },
    { "id": 2064, "name": "Poblacion" },
    { "id": 2065, "name": "San Isidro" }
],

'Maragusan': [
    { "id": 2066, "name": "Anitapan" },
    { "id": 2067, "name": "Badiang" },
    { "id": 2068, "name": "Binucay" },
    { "id": 2069, "name": "Cutog" },
    { "id": 2070, "name": "Don Martin" },
    { "id": 2071, "name": "Kauswagan" },
    { "id": 2072, "name": "Poblacion" },
    { "id": 2073, "name": "Rizal" }
],

'Tagum City': [
    { "id": 2074, "name": "Apokon" },
    { "id": 2075, "name": "Bincungan" },
    { "id": 2076, "name": "Magugpo Poblacion" },
    { "id": 2077, "name": "Mankilam" },
    { "id": 2078, "name": "New Balamban" },
    { "id": 2079, "name": "San Miguel" },
    { "id": 2080, "name": "Santo Niño" },
    { "id": 2081, "name": "Visayan" }
],

'Panabo City': [
    { "id": 2082, "name": "Carmen" },
    { "id": 2083, "name": "Datu Balong" },
    { "id": 2084, "name": "Kasilak" },
    { "id": 2085, "name": "New Katipunan" },
    { "id": 2086, "name": "Old Tagpao" },
    { "id": 2087, "name": "San Isidro" },
    { "id": 2088, "name": "San Juan" }
],

'Island Garden City of Samal': [
    { "id": 2089, "name": "Adecor" },
    { "id": 2090, "name": "Anonang" },
    { "id": 2091, "name": "Babak" },
    { "id": 2092, "name": "Barangay Capital" },
    { "id": 2093, "name": "Camudmud" },
    { "id": 2094, "name": "Catagman" },
    { "id": 2095, "name": "Dacudao" },
    { "id": 2096, "name": "Mambago" },
    { "id": 2097, "name": "Marfori" }
],

'Davao City': [
    { "id": 2098, "name": "Davao City" }
],

'Malita': [

    { "id": 2100, "name": "Sambon" },
    { "id": 2101, "name": "Libudon" },
    { "id": 2102, "name": "Tungao" },
    { "id": 2103, "name": "Nagpan" },
    { "id": 2104, "name": "Magdum" }
],

'Santa Maria': [

    { "id": 2106, "name": "Pag-asa" },
    { "id": 2107, "name": "Talisay" }
],

'Don Marcelino': [

    { "id": 2109, "name": "Tuganay" },
    { "id": 2110, "name": "Lambog" }
],

'Jose Abad Santos': [

    { "id": 2112, "name": "San Roque" },
    { "id": 2113, "name": "Poblacion" }
],



'Mati City': [

    { "id": 2118, "name": "Sabang" },
    { "id": 2119, "name": "San Isidro" }
],

'Baganga': [

    { "id": 2121, "name": "Cagwait" },
    { "id": 2122, "name": "Maligaya" }
],

'Cateel': [

    { "id": 2124, "name": "Ibos" },
    { "id": 2125, "name": "Poblacion" }
],

'Boston': [

    { "id": 2127, "name": "San Jose" },
    { "id": 2128, "name": "San Pedro" }
],

'Governor Generoso': [

    { "id": 2130, "name": "Bangkalan" },
    { "id": 2131, "name": "San Antonio" }
],
'Digos City': [
        { "id": 2132, "name": "Aplaya" },
        { "id": 2133, "name": "Cogon" },
        { "id": 2134, "name": "Dulangan" },
        { "id": 2135, "name": "Sinawilan" },
        { "id": 2136, "name": "Rizal" },
        { "id": 2137, "name": "San Jose" },
        { "id": 2138, "name": "San Miguel" },
        { "id": 2139, "name": "San Roque" },
        { "id": 2140, "name": "San Isidro" },
        { "id": 2141, "name": "Balabag" },
        { "id": 2142, "name": "Binaton" },
        { "id": 2143, "name": "Goma" },
        { "id": 2144, "name": "Igpit" },
        { "id": 2145, "name": "Kapatagan" },
        { "id": 2146, "name": "Kiagot" },
        { "id": 2147, "name": "Lungag" },
        { "id": 2148, "name": "Magsaysay" },
        { "id": 2149, "name": "Matina Biao" },
        { "id": 2150, "name": "Ruparan" },
        { "id": 2151, "name": "Soong" },
        { "id": 2152, "name": "Tagabuli" },
        { "id": 2153, "name": "Tres de Mayo" }
    ],
    'Bansalan': [
        { "id": 2201, "name": "Managa" },
        { "id": 2202, "name": "Kinuskusan" },
        { "id": 2203, "name": "Villa Doneza" },
        { "id": 2204, "name": "San Vicente" },
        { "id": 2205, "name": "Sinapulan" },
        { "id": 2206, "name": "Tabon" },
        { "id": 2207, "name": "Santo Niño" },
        { "id": 2208, "name": "Marilog" },
        { "id": 2209, "name": "Don Marcelino" },
        { "id": 2210, "name": "Padada" },
        { "id": 2211, "name": "Lawigan" },
        { "id": 2212, "name": "Langub" },
        { "id": 2213, "name": "Parang" },
        { "id": 2214, "name": "Mabuhay" },
        { "id": 2215, "name": "Mendez" },
        { "id": 2216, "name": "Nagbay" },
        { "id": 2217, "name": "Pilan" },
        { "id": 2218, "name": "Rizal" },
        { "id": 2219, "name": "San Jose" },
        { "id": 2220, "name": "Pogondol" },
        { "id": 2221, "name": "Panabo" },
        { "id": 2222, "name": "Marilog" },
        { "id": 2223, "name": "Lico" }
    ],
    'Hagonoy': [
        { "id": 2301, "name": "Clib" },
        { "id": 2302, "name": "Guihing" },
        { "id": 2303, "name": "San Guillermo" },
        { "id": 2304, "name": "Kampung" },
        { "id": 2305, "name": "Abo" },
        { "id": 2306, "name": "Olap" },
        { "id": 2307, "name": "Lumbayan" },
        { "id": 2308, "name": "Concepcion" },
        { "id": 2309, "name": "Bolo" },
        { "id": 2310, "name": "Banaybanay" },
        { "id": 2311, "name": "Quezon" },
        { "id": 2312, "name": "Balundoni" },
        { "id": 2313, "name": "Mansibang" },
        { "id": 2314, "name": "Cawayan" },
        { "id": 2315, "name": "Bugsukan" },
        { "id": 2316, "name": "Sariaya" },
        { "id": 2317, "name": "Lugos" },
        { "id": 2318, "name": "Siambacan" },
        { "id": 2319, "name": "Balatoc" },
        { "id": 2320, "name": "Bacud" },
        { "id": 2321, "name": "Pinto" }
    ],
    'Kiblawan': [
        { "id": 2401, "name": "Bagumbayan" },
        { "id": 2402, "name": "Kimlawis" },
        { "id": 2403, "name": "Balasiao" },
        { "id": 2404, "name": "Milan" },
        { "id": 2405, "name": "Baganihan" },
        { "id": 2406, "name": "Pangil" },
        { "id": 2407, "name": "Datalblao" },
        { "id": 2408, "name": "Salumay" },
        { "id": 2409, "name": "New Esperanza" },
        { "id": 2410, "name": "Kanipaan" },
        { "id": 2411, "name": "Tambacan" },
        { "id": 2412, "name": "Sta. Teresa" },
        { "id": 2413, "name": "Quezon" },
        { "id": 2414, "name": "Kabilan" },
        { "id": 2415, "name": "Matundan" },
        { "id": 2416, "name": "Pinto" },
        { "id": 2417, "name": "Macario" },
        { "id": 2418, "name": "Barangay" }
    ],
    'Magsaysay': [
        { "id": 2501, "name": "Malawanit" },
        { "id": 2502, "name": "San Isidro" },
        { "id": 2503, "name": "Tacul" },
        { "id": 2504, "name": "Panabo" },
        { "id": 2505, "name": "Tampus" },
        { "id": 2506, "name": "San Jose" },
        { "id": 2507, "name": "Santo Niño" },
        { "id": 2508, "name": "Bula" },
        { "id": 2509, "name": "Sta. Fe" },
        { "id": 2510, "name": "Malasila" },
        { "id": 2511, "name": "Tuminog" },
        { "id": 2512, "name": "Bagumbayan" },
        { "id": 2513, "name": "Matimbag" }
    ],
    'Malalag': [
        { "id": 2601, "name": "Baybay" },
        { "id": 2602, "name": "Pitu" },
        { "id": 2603, "name": "Tuban" },
        { "id": 2604, "name": "Kalilangan" },
        { "id": 2605, "name": "Pangil" },
        { "id": 2606, "name": "Panang" },
        { "id": 2607, "name": "San Carlos" },
        { "id": 2608, "name": "Lipay" },
        { "id": 2609, "name": "Tapos" },
        { "id": 2610, "name": "Tabuk" },
        { "id": 2611, "name": "Sinapulan" },
        { "id": 2612, "name": "Suwant" },
        { "id": 2613, "name": "Mahadlo" },
        { "id": 2614, "name": "Parara" }
    ],
    'Matanao': [
        { "id": 2701, "name": "Asbang" },
        { "id": 2702, "name": "Buas" },
        { "id": 2703, "name": "Mangaoang" },
        { "id": 2704, "name": "Kansip" },
        { "id": 2705, "name": "Bucana" },
        { "id": 2706, "name": "Alo" },
        { "id": 2707, "name": "Banana" },
        { "id": 2708, "name": "Sampaguita" },
        { "id": 2709, "name": "Managok" },
        { "id": 2710, "name": "Mabuhay" },
        { "id": 2711, "name": "Kalamag" },
        { "id": 2712, "name": "Asbo" },
        { "id": 2713, "name": "Tapon" },
        { "id": 2714, "name": "Balisang" },
        { "id": 2715, "name": "Matandang" }
    ],
    'Padada': [
        { "id": 2801, "name": "Almendras" },
        { "id": 2802, "name": "Palili" },
        { "id": 2803, "name": "Tagabuli" },
        { "id": 2804, "name": "Bansalan" },
        { "id": 2805, "name": "Magsaysay" },
        { "id": 2806, "name": "Rizal" },
        { "id": 2807, "name": "Magkil" },
        { "id": 2808, "name": "Banaba" },
        { "id": 2809, "name": "Sumisan" },
        { "id": 2810, "name": "Tabuy" }
    ],
    'Santa Cruz': [
        { "id": 2901, "name": "Darong" },
        { "id": 2902, "name": "Inawayan" },
        { "id": 2903, "name": "Tibolo" },
        { "id": 2904, "name": "Tungyawan" },
        { "id": 2905, "name": "Aplaya" },
        { "id": 2906, "name": "Tabon" },
        { "id": 2907, "name": "Santo Niño" },
        { "id": 2908, "name": "Magcuya" },
        { "id": 2909, "name": "Kabilang" },
        { "id": 2910, "name": "Mabuhay" },
        { "id": 2911, "name": "Carasco" },
        { "id": 2912, "name": "Mabilog" }
    ],
    'Sulop': [
        { "id": 3001, "name": "Tadaw" },
        { "id": 3002, "name": "Alangilan" },
        { "id": 3003, "name": "Lunocan" },
        { "id": 3004, "name": "Tabug" },
        { "id": 3006, "name": "Sinapulang" },
        { "id": 3007, "name": "Malinao" },
        { "id": 3008, "name": "Balidong" },
        { "id": 3009, "name": "Pangaan" },
        { "id": 3010, "name": "Loma" }
    ],
    'Kidapawan City': [
    { "id": 30011, "name": "Bagontapay" },
    { "id": 30012, "name": "Balabag" },
    { "id": 30013, "name": "Bano" },
    { "id": 30014, "name": "Banisilan" },
    { "id": 30015, "name": "Basak" },
    { "id": 30016, "name": "Batasan" },
    { "id": 30017, "name": "Malayan" },
    { "id": 30018, "name": "Manubuan" },
    { "id": 30019, "name": "Poblacion" },
    { "id": 30020, "name": "San Isidro" },
    { "id": 30021, "name": "San Jose" },
    { "id": 30022, "name": "San Vicente" },
    { "id": 30023, "name": "Sibsib" },
    { "id": 30024, "name": "Singao" },
    { "id": 30025, "name": "Malandag" },
    { "id": 30026, "name": "Magsaysay" },
    { "id": 30027, "name": "Matalam" },
    { "id": 30028, "name": "Upper Malanday" }
],
'Midsayap': [
    { "id": 30031, "name": "Bagumbayan" },
    { "id": 30032, "name": "Bual" },
    { "id": 30033, "name": "Dungguan" },
    { "id": 30034, "name": "Kulambog" },
    { "id": 30035, "name": "Kusiong" },
    { "id": 30036, "name": "Lao" },
    { "id": 30037, "name": "Laping" },
    { "id": 30038, "name": "Malamote" },
    { "id": 30039, "name": "Midsayap" },
    { "id": 30040, "name": "Poblacion" },
    { "id": 30041, "name": "Rajah Muda" },
    { "id": 30042, "name": "San Isidro" },
    { "id": 30043, "name": "San Mateo" },
    { "id": 30044, "name": "Tangcal" },
    { "id": 30045, "name": "Tumahubong" }
],
'Matalam': [
    { "id": 30051, "name": "Bagumbayan" },
    { "id": 30052, "name": "Balatikan" },
    { "id": 30053, "name": "Banugao" },
    { "id": 30054, "name": "Bualan" },
    { "id": 30055, "name": "Kabasalan" },
    { "id": 30056, "name": "Kabilan" },
    { "id": 30057, "name": "Kanaan" },
    { "id": 30058, "name": "Kapitan" },
    { "id": 30059, "name": "Layon" },
    { "id": 30060, "name": "Lumbayan" },
    { "id": 30061, "name": "Luta" },
    { "id": 30062, "name": "Magsaysay" },
    { "id": 30063, "name": "Poblacion" },
    { "id": 30064, "name": "Rarab" },
    { "id": 30065, "name": "San Isidro" },
    { "id": 30066, "name": "San Vicente" }
],
'Pikit': [
    { "id": 30071, "name": "Bagumbayan" },
    { "id": 30072, "name": "Balindog" },
    { "id": 30073, "name": "Kudal" },
    { "id": 30074, "name": "Lanao" },
    { "id": 30075, "name": "Limbo" },
    { "id": 30076, "name": "Malibago" },
    { "id": 30077, "name": "Malingao" },
    { "id": 30078, "name": "Manuang" },
    { "id": 30079, "name": "Poblacion" },
    { "id": 30080, "name": "Pulo" },
    { "id": 30081, "name": "Saliao" },
    { "id": 30082, "name": "San Isidro" },
    { "id": 30083, "name": "San Jose" },
    { "id": 30084, "name": "Santo Niño" },
    { "id": 30085, "name": "Upper Poblacion" }
],
'Kabacan': [
    { "id": 30091, "name": "Bagumbayan" },
    { "id": 30092, "name": "Banate" },
    { "id": 30093, "name": "Bangkilan" },
    { "id": 30094, "name": "Bantuan" },
    { "id": 30095, "name": "Poblacion" },
    { "id": 30096, "name": "Saranay" },
    { "id": 30097, "name": "Sampao" },
    { "id": 30098, "name": "San Isidro" },
    { "id": 30099, "name": "San Jose" },
    { "id": 30100, "name": "San Vicente" },
    { "id": 30101, "name": "Tapayan" }
],
'Alabel': [
    { "id": 30102, "name": "Daliao" },
    { "id": 30103, "name": "Lumatil" },
    { "id": 30104, "name": "Maan" },
    { "id": 30105, "name": "New Alabel" },
    { "id": 30106, "name": "Poblacion" },
    { "id": 30107, "name": "Suli" },
    { "id": 30108, "name": "Tuyan" },
    { "id": 30109, "name": "Upper Suyan" },
    { "id": 30110, "name": "Napo" },
    { "id": 30111, "name": "Maribulan" },
    { "id": 30112, "name": "Pangyan" },
    { "id": 30113, "name": "Limulan" }
],
'Malungon': [
    { "id": 30201, "name": "Alkikan" },
    { "id": 30202, "name": "Ampon" },
    { "id": 30203, "name": "Atlae" },
    { "id": 30204, "name": "B'Laan" },
    { "id": 30205, "name": "Banahaw" },
    { "id": 30206, "name": "Banate" },
    { "id": 30207, "name": "Datal Batong" },
    { "id": 30208, "name": "Datal Anggas" },
    { "id": 30209, "name": "Datal Zuan" },
    { "id": 30210, "name": "Gasi" },
    { "id": 30211, "name": "Lagunde" },
    { "id": 30212, "name": "Kauswagan" },
    { "id": 30213, "name": "Manluy-a" },
    { "id": 30214, "name": "Poblacion" },
    { "id": 30215, "name": "Taguik" },
    { "id": 30216, "name": "Tongtongan" },
    { "id": 30217, "name": "Datal Lampan" },
    { "id": 30218, "name": "Salus" }
],
'Kiamba': [
    { "id": 30301, "name": "Badtasan" },
    { "id": 30302, "name": "Datu Dani" },
    { "id": 30303, "name": "Gasi" },
    { "id": 30304, "name": "Kapate" },
    { "id": 30305, "name": "Katubao" },
    { "id": 30306, "name": "Kayupo" },
    { "id": 30307, "name": "Kling" },
    { "id": 30308, "name": "Lagundi" },
    { "id": 30309, "name": "Lebe" },
    { "id": 30310, "name": "Lomuyon" },
    { "id": 30311, "name": "Luma" },
    { "id": 30312, "name": "Maligang" },
    { "id": 30313, "name": "Nalus" },
    { "id": 30314, "name": "Poblacion" },
    { "id": 30315, "name": "Salakit" },
    { "id": 30316, "name": "Suli" },
    { "id": 30317, "name": "Tablao" },
    { "id": 30318, "name": "Tamadang" },
    { "id": 30319, "name": "Tambilil" }
],
'Maasim': [
    { "id": 30401, "name": "Amsipit" },
    { "id": 30402, "name": "Bales" },
    { "id": 30403, "name": "Colon" },
    { "id": 30404, "name": "Daliao" },
    { "id": 30405, "name": "Kabatiol" },
    { "id": 30406, "name": "Kablacan" },
    { "id": 30407, "name": "Kamanga" },
    { "id": 30408, "name": "Kanalo" },
    { "id": 30409, "name": "Lumasal" },
    { "id": 30410, "name": "Lumatil" },
    { "id": 30411, "name": "Malbang" },
    { "id": 30412, "name": "Nomoh" },
    { "id": 30413, "name": "Pananag" },
    { "id": 30414, "name": "Poblacion" },
    { "id": 30415, "name": "Seven Hills" },
    { "id": 30416, "name": "Tinoto" }
],
'Glan': [
    { "id": 30501, "name": "Calpidong" },
    { "id": 30502, "name": "Congan" },
    { "id": 30503, "name": "Cross" },
    { "id": 30504, "name": "Datalbukay" },
    { "id": 30505, "name": "E. Alegado" },
    { "id": 30506, "name": "Glan Padidu" },
    { "id": 30507, "name": "Gumasa" },
    { "id": 30508, "name": "Ilaya" },
    { "id": 30509, "name": "Kaltuad" },
    { "id": 30510, "name": "Kapatan" },
    { "id": 30511, "name": "Lago" },
    { "id": 30512, "name": "Laguimit" },
    { "id": 30513, "name": "Mudan" },
    { "id": 30514, "name": "New Aklan" },
    { "id": 30515, "name": "Pangyan" },
    { "id": 30516, "name": "Poblacion" },
    { "id": 30517, "name": "Rio del Pilar" },
    { "id": 30518, "name": "San Jose" },
    { "id": 30519, "name": "San Vicente" },
    { "id": 30520, "name": "Small Margus" },
    { "id": 30521, "name": "Sufatubo" },
    { "id": 30522, "name": "Taluya" },
    { "id": 30523, "name": "Tango" },
    { "id": 30524, "name": "Tapon" }
],
'General Santos City': [
  { "id": 30525, "name": "Apopong" },
  { "id": 30526, "name": "Baluan" },
  { "id": 30527, "name": "Batomelong" },
  { "id": 30528, "name": "Buayan" },
  { "id": 30529, "name": "Bula" },
  { "id": 30530, "name": "Calumpang" },
  { "id": 30531, "name": "City Heights" },
  { "id": 30532, "name": "Conel" },
  { "id": 30533, "name": "Dadiangas East" },
  { "id": 30534, "name": "Dadiangas North" },
  { "id": 30535, "name": "Dadiangas South" },
  { "id": 30536, "name": "Dadiangas West" },
  { "id": 30537, "name": "Fatima" },
  { "id": 30538, "name": "Katangawan" },
  { "id": 30539, "name": "Labangal" },
  { "id": 30540, "name": "Lagao" },
  { "id": 30541, "name": "Ligaya" },
  { "id": 30542, "name": "Mabuhay" },
  { "id": 30543, "name": "Olympog" },
  { "id": 30544, "name": "San Isidro" },
  { "id": 30545, "name": "San Jose" },
  { "id": 30546, "name": "Siguel" },
  { "id": 30547, "name": "Sinawal" },
  { "id": 30548, "name": "Tambler" },
  { "id": 30549, "name": "Tinagacan" },
  { "id": 30550, "name": "Upper Labay" }
],
'Koronadal City': [
    { "id": 30551, "name": "Assumption (Bulol)" },
    { "id": 30552, "name": "Avanceña (Bo. 3)" },
    { "id": 30553, "name": "Cacub" },
    { "id": 30554, "name": "Caloocan" },
    { "id": 30555, "name": "Carpenter Hill" },
    { "id": 30556, "name": "Concepcion (Bo. 6)" },
    { "id": 30557, "name": "Esperanza" },
    { "id": 30558, "name": "General Paulino Santos (Bo. 1)" },
    { "id": 30559, "name": "Mabini" },
    { "id": 30560, "name": "Magsaysay" },
    { "id": 30561, "name": "Mambucal" },
    { "id": 30562, "name": "Morales (Urban)" },
    { "id": 30563, "name": "Namnama" },
    { "id": 30564, "name": "New Pangasinan (Bo. 4)" },
    { "id": 30565, "name": "Paraiso" },
    { "id": 30566, "name": "Rotonda" },
    { "id": 30567, "name": "San Isidro" },
    { "id": 30568, "name": "San Jose (Bo. 5)" },
    { "id": 30569, "name": "San Roque" },
    { "id": 30570, "name": "Santa Cruz (Urban)" },
    { "id": 30571, "name": "Santo Niño (Bo. 2) (Urban)" },
    { "id": 30572, "name": "Saravia (Bo. 8)" },
    { "id": 30573, "name": "Topland (Bo. 7)" },
    { "id": 30574, "name": "Zone 1 (Poblacion)" },
    { "id": 30575, "name": "Zone 2 (Poblacion)" },
    { "id": 30576, "name": "Zone 3 (Poblacion)" },
    { "id": 30577, "name": "Zone 4 (Poblacion)" }
],
'Surallah': [ 
    { "id": 30578, "name": "Buenavista" },
    { "id": 30579, "name": "Centrala" },
    { "id": 30580, "name": "Colongulo" },
    { "id": 30581, "name": "Dajay" },
    { "id": 30582, "name": "Duengas" },
    { "id": 30583, "name": "Lambontong" },
    { "id": 30584, "name": "Lamsugod" },
    { "id": 30585, "name": "Libertad" },
    { "id": 30586, "name": "Little Baguio" },
    { "id": 30587, "name": "Moloy" },
    { "id": 30588, "name": "Naci" },
    { "id": 30589, "name": "Talahik" },
    { "id": 30590, "name": "Tbolok" },
    { "id": 30591, "name": "Upper Sepaka" },
    { "id": 30592, "name": "Veterans" },
    { "id": 30593, "name": "Poblacion" },
    { "id": 30594, "name": "Canahay" }
],
'Tupi': [ 
    { "id": 30594, "name": "Acmonan" },
    { "id": 30595, "name": "Bololmala" },
    { "id": 30596, "name": "Bunao" },
    { "id": 30597, "name": "Crossing Rubber" },
    { "id": 30598, "name": "Kablon" },
    { "id": 30599, "name": "Linan" },
    { "id": 30600, "name": "Lunen" },
    { "id": 30601, "name": "Poblacion" },
    { "id": 30602, "name": "Polonuling" },
    { "id": 30603, "name": "Simbo" },
    { "id": 30604, "name": "Tubeng" }
],

'Banga': [
    { "id": 30605, "name": "Benitez (Poblacion)" },
    { "id": 30606, "name": "Cabudian" },
    { "id": 30607, "name": "Cabuling" },
    { "id": 30608, "name": "Cinco (Barrio 5)" },
    { "id": 30609, "name": "Derilon" },
    { "id": 30610, "name": "El Nonok" },
    { "id": 30611, "name": "Improgo Village (Poblacion)" },
    { "id": 30612, "name": "Kusan (Barrio 8)" },
    { "id": 30613, "name": "Lam-Apos" },
    { "id": 30614, "name": "Lamba" },
    { "id": 30615, "name": "Lambingi" },
    { "id": 30616, "name": "Lampari" },
    { "id": 30617, "name": "Liwanay (Barrio 1)" },
    { "id": 30618, "name": "Malaya (Barrio 9)" },
    { "id": 30619, "name": "Punong Grande (Barrio 2)" },
    { "id": 30620, "name": "Rang-ay (Barrio 4)" },
    { "id": 30621, "name": "Reyes (Poblacion)" },
    { "id": 30622, "name": "Rizal (Barrio 3)" },
    { "id": 30623, "name": "Rizal Poblacion" },
    { "id": 30624, "name": "San Jose (Barrio 7)" },
    { "id": 30625, "name": "San Vicente (Barrio 6)" },
    { "id": 30626, "name": "Yangco Poblacion" }
],
'Tacurong City': [
    { "id": 30627, "name": "Baras" },
    { "id": 30628, "name": "Buenaflor" },
    { "id": 30629, "name": "Calean" },
    { "id": 30630, "name": "D'lotilla" },
    { "id": 30631, "name": "Griño" },
    { "id": 30632, "name": "Kalandagan" },
    { "id": 30633, "name": "Lancheta" },
    { "id": 30634, "name": "New Isabela" },
    { "id": 30635, "name": "New Lagao" },
    { "id": 30636, "name": "Poblacion" },
    { "id": 30637, "name": "San Antonio" },
    { "id": 30638, "name": "San Emmanuel" },
    { "id": 30639, "name": "San Pablo" },
    { "id": 30640, "name": "Upper Katungal" }
],
'Isulan': [
    { "id": 30701, "name": "Bambad" },
    { "id": 30702, "name": "Bual" },
    { "id": 30703, "name": "Dansuli" },
    { "id": 30704, "name": "Impao" },
    { "id": 30705, "name": "Kalawag I" },
    { "id": 30706, "name": "Kalawag II" },
    { "id": 30707, "name": "Kalawag III" },
    { "id": 30708, "name": "Kenram" },
    { "id": 30709, "name": "Kudanding" },
    { "id": 30710, "name": "Lagandang" },
    { "id": 30711, "name": "Laguinding" },
    { "id": 30712, "name": "Mapantig" },
    { "id": 30713, "name": "New Pangasinan" },
    { "id": 30714, "name": "Sampao" },
    { "id": 30715, "name": "Tayugo" },
    { "id": 30716, "name": "Villamor" }
],
'Lambayong': [
    { "id": 30801, "name": "Baluan" },
    { "id": 30802, "name": "Bilumin" },
    { "id": 30803, "name": "Didtaras" },
    { "id": 30804, "name": "Kapingkong" },
    { "id": 30805, "name": "Madanding" },
    { "id": 30806, "name": "Maligaya" },
    { "id": 30807, "name": "Mamali" },
    { "id": 30808, "name": "Midtapok" },
    { "id": 30809, "name": "Pimbalayan" },
    { "id": 30810, "name": "Poblacion" },
    { "id": 30811, "name": "Sadsalan" },
    { "id": 30812, "name": "Sigayan" },
    { "id": 30813, "name": "Tinumigues" }
],
'Sen. Ninoy Aquino': [
    { "id": 30901, "name": "Banali" },
    { "id": 30902, "name": "Basag" },
    { "id": 30903, "name": "Buenaflores" },
    { "id": 30904, "name": "Kadi" },
    { "id": 30905, "name": "Kapatagan" },
    { "id": 30906, "name": "Kiadsam" },
    { "id": 30907, "name": "Kulaman" },
    { "id": 30908, "name": "Lagubang" },
    { "id": 30909, "name": "Malegdeg" },
    { "id": 30910, "name": "Midtungok" },
    { "id": 30911, "name": "Nati" },
    { "id": 30912, "name": "Sewod" },
    { "id": 30913, "name": "Tacupis" },
    { "id": 30914, "name": "Tinalon" }
],
'Palimbang': [
    { "id": 31001, "name": "Baluan" },
    { "id": 31002, "name": "Colongulo" },
    { "id": 31003, "name": "Kanipaan" },
    { "id": 31004, "name": "Kalatang" },
    { "id": 31005, "name": "Kalian" },
    { "id": 31006, "name": "Ligaya" },
    { "id": 31007, "name": "Lumunod" },
    { "id": 31008, "name": "Maganao" },
    { "id": 31009, "name": "Malatunol" },
    { "id": 31010, "name": "Matagobong" },
    { "id": 31011, "name": "Mina" },
    { "id": 31012, "name": "Milbuk" },
    { "id": 31013, "name": "Napnapon" },
    { "id": 31014, "name": "Pinol" },
    { "id": 31015, "name": "Poblacion" },
    { "id": 31016, "name": "Wal" }
],
'Butuan City': [
    { "id": 31016, "name": "Agusan" },
    { "id": 31017, "name": "Alubihid" },
    { "id": 31018, "name": "Ambago" },
    { "id": 31019, "name": "Balangay" },
    { "id": 31020, "name": "Bayanihan" },
    { "id": 31021, "name": "Baan" },
    { "id": 31022, "name": "Doongan" },
    { "id": 31023, "name": "Libertad" },
    { "id": 31024, "name": "Magsaysay" },
    { "id": 31025, "name": "Bancasi" },
    { "id": 31026, "name": "Villa Kananga" }
],
'Cabadbaran City': [
    { "id": 31026, "name": "Andanan" },
    { "id": 31027, "name": "Banban" },
    { "id": 31028, "name": "Batangan" },
    { "id": 31029, "name": "Bonbon" },
    { "id": 31030, "name": "Gango" },
    { "id": 31031, "name": "Gusa" },
    { "id": 31032, "name": "Imelda" },
    { "id": 31033, "name": "Mabini" },
    { "id": 31034, "name": "Mahayahay" },
    { "id": 31035, "name": "Manlilisid" },
    { "id": 31036, "name": "Poblacion" },
    { "id": 31037, "name": "Salsalon" },
    { "id": 31038, "name": "San Isidro" },
    { "id": 31039, "name": "San Vicente" },
    { "id": 31040, "name": "Santo Niño" }
],

'Bayugan City': [
    { "id": 31041, "name": "Baño" },
    { "id": 31042, "name": "Banban" },
    { "id": 31043, "name": "Bantac" },
    { "id": 31044, "name": "Bilangbilangan" },
    { "id": 31045, "name": "Kalubihan" },
    { "id": 31046, "name": "Mahayahay" },
    { "id": 31047, "name": "Manlilisid" },
    { "id": 31048, "name": "Poblacion" },
    { "id": 31049, "name": "San Isidro" },
    { "id": 31050, "name": "San Vicente" },
    { "id": 31051, "name": "Santo Niño" }
],

'Surigao City': [
    { "id": 31052, "name": "Alang-alang" },
    { "id": 31053, "name": "Bagumbayan" },
    { "id": 31054, "name": "Bancasi" },
    { "id": 31055, "name": "Caño" },
    { "id": 31056, "name": "Del Pilar" },
    { "id": 31057, "name": "Doña Helen" },
    { "id": 31058, "name": "Ipil" },
    { "id": 31059, "name": "Mabini" },
    { "id": 31060, "name": "Nagkahiusang Barangay" },
    { "id": 31061, "name": "Poblacion" },
    { "id": 31062, "name": "San Juan" },
    { "id": 31063, "name": "San Vicente" },
    { "id": 31064, "name": "Surigao" }
],

'Del Carmen': [
    { "id": 31065, "name": "Cabadbaran" },
    { "id": 31066, "name": "Magsaysay" },
    { "id": 31067, "name": "Poblacion" },
    { "id": 31068, "name": "San Isidro" },
    { "id": 31069, "name": "San Vicente" },
    { "id": 31070, "name": "Tagbuno" },
    { "id": 31071, "name": "Tiningguian" }
],

'Sison': [
    { "id": 31072, "name": "Ipil" },
    { "id": 31073, "name": "Magsaysay" },
    { "id": 31074, "name": "Poblacion" },
    { "id": 31075, "name": "San Isidro" },
    { "id": 31076, "name": "Santo Niño" }
],

'Claver': [
    { "id": 31077, "name": "Bagumbayan" },
    { "id": 31078, "name": "Baclag" },
    { "id": 31079, "name": "Calabayan" },
    { "id": 31080, "name": "Kasapa" },
    { "id": 31081, "name": "Poblacion" },
    { "id": 31082, "name": "San Vicente" }
],

'Tandag City': [
    { "id": 31083, "name": "Alangan" },
    { "id": 31084, "name": "Baculin" },
    { "id": 31085, "name": "Del Pilar" },
    { "id": 31086, "name": "Libertad" },
    { "id": 31087, "name": "Poblacion" },
    { "id": 31088, "name": "San Juan" },
    { "id": 31089, "name": "San Vicente" },
    { "id": 31090, "name": "San Isidro" }
],

'Bislig City': [
    { "id": 31091, "name": "Awasian" },
    { "id": 31092, "name": "Bagumbayan" },
    { "id": 31093, "name": "Bananay" },
    { "id": 31094, "name": "Ban-ao" },
    { "id": 31095, "name": "Buhangin" },
    { "id": 31096, "name": "Buhisan" },
    { "id": 31097, "name": "Poblacion" },
    { "id": 31098, "name": "San Isidro" },
    { "id": 31099, "name": "San Vicente" },
    { "id": 31100, "name": "Talisay" }
],

'Carrascal': [
    { "id": 31101, "name": "Bayabas" },
    { "id": 31102, "name": "Buhangin" },
    { "id": 31103, "name": "San Vicente" },
    { "id": 31104, "name": "Talisay" }
],

'Madrid': [
    { "id": 31105, "name": "Antipolo" },
    { "id": 31106, "name": "Calating" },
    { "id": 31107, "name": "Guisijan" },
    { "id": 31108, "name": "Libertad" },
    { "id": 31109, "name": "Poblacion" },
    { "id": 31110, "name": "San Isidro" }
],

'Dinagat': [
    { "id": 31111, "name": "Albor" },
    { "id": 31112, "name": "Bagumbayan" },
    { "id": 31113, "name": "Cagdianao" },
    { "id": 31114, "name": "Doña Helene" },
    { "id": 31115, "name": "Justiniana" },
    { "id": 31116, "name": "Magsaysay" },
    { "id": 31117, "name": "Libjo" },
    { "id": 31118, "name": "San Jose" },
    { "id": 31119, "name": "San Vicente" }
],

'Cagdianao': [
    { "id": 31120, "name": "Boa" },
    { "id": 31121, "name": "Cabunga-an" },
    { "id": 31122, "name": "Del Pilar" },
    { "id": 31123, "name": "Laguna" },
    { "id": 31124, "name": "Legaspi" },
    { "id": 31125, "name": "Ma-atas" },
    { "id": 31126, "name": "Mabini" },
    { "id": 31127, "name": "Nueva Estrella" },
    { "id": 31128, "name": "Poblacion" },
    { "id": 31129, "name": "San Jose" },
    { "id": 31130, "name": "Santa Rita" }
],
'Basilisa': [
    { "id": 31131, "name": "Bangon" },
    { "id": 31132, "name": "Bagumbayan" },
    { "id": 31133, "name": "Barrio 1" },
    { "id": 31134, "name": "Barrio 2" },
    { "id": 31135, "name": "Poblacion" },
    { "id": 31136, "name": "San Isidro" }
],

'San Jose': [
    { "id": 31137, "name": "Barangay 1" },
    { "id": 31138, "name": "Barangay 2" },
    { "id": 31139, "name": "Barangay 3" },
    { "id": 31140, "name": "Barangay 4" },
    { "id": 31141, "name": "Barangay 5" },
    { "id": 31142, "name": "Poblacion" }
]















    







            
    };

    let barangaySelect = document.getElementById('barangay');
    let cityName = document.getElementById('city').value;

    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';  // Reset options
    if (cityName && barangays[cityName]) {
        barangays[cityName].forEach(barangay => {
            let option = document.createElement('option');
            option.value = barangay.name;  // Set value to the barangay name
            option.text = barangay.name;
            barangaySelect.appendChild(option);
        });
    }
}
