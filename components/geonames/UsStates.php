<?php
namespace app\components\geonames;

class UsStates {
    public static $cton=array(
        'AL'=>'Alabama',
        'AK'=>'Alaska',
        'AS'=>'American Samoa',
        'AZ'=>'Arizona',
        'AR'=>'Arkansas',
        'CA'=>'California',
        'CO'=>'Colorado',
        'CT'=>'Connecticut',
        'DE'=>'Delaware',
        'DC'=>'District of Columbia',
        'FM'=>'Federated States of Micronesia',
        'FL'=>'Florida',
        'GA'=>'Georgia',
        'GU'=>'Guam',
        'HI'=>'Hawaii',
        'ID'=>'Idaho',
        'IL'=>'Illinois',
        'IN'=>'Indiana',
        'IA'=>'Iowa',
        'KS'=>'Kansas',
        'KY'=>'Kentucky',
        'LA'=>'Louisiana',
        'ME'=>'Maine',
        'MH'=>'Marshall Islands',
        'MD'=>'Maryland',
        'MA'=>'Massachusetts',
        'MI'=>'Michigan',
        'MN'=>'Minnesota',
        'MS'=>'Mississippi',
        'MO'=>'Missouri',
        'MT'=>'Montana',
        'NE'=>'Nebraska',
        'NV'=>'Nevada',
        'NH'=>'New Hampshire',
        'NJ'=>'New Jersey',
        'NM'=>'New Mexico',
        'NY'=>'New York',
        'NC'=>'North Carolina',
        'ND'=>'North Dakota',
        'MP'=>'Northern Mariana Islands',
        'OH'=>'Ohio',
        'OK'=>'Oklahoma',
        'OR'=>'Oregon',
        'PW'=>'Palau',
        'PA'=>'Pennsylvania',
        'PR'=>'Puerto Rico',
        'RI'=>'Rhode Island',
        'SC'=>'South Carolina',
        'SD'=>'South Dakota',
        'TN'=>'Tennessee',
        'TX'=>'Texas',
        'UT'=>'Utah',
        'VT'=>'Vermont',
        'VI'=>'Virgin Islands',
        'VA'=>'Virginia',
        'WA'=>'Washington',
        'WV'=>'West Virginia',
        'WI'=>'Wisconsin',
        'WY'=>'Wyoming',
        'AE'=>'Armed Forces Europe, the Middle East, and Canada',
        'AP'=>'Armed Forces Pacific',
        'AA'=>'Armed Forces Americas (except Canada)'
    );

    public static $ntoc=array(
        'Alabama'=>'AL',
        'Alaska'=>'AK',
        'American Samoa'=>'AS',
        'Arizona'=>'AZ',
        'Arkansas'=>'AR',
        'California'=>'CA',
        'Colorado'=>'CO',
        'Connecticut'=>'CT',
        'Delaware'=>'DE',
        'District of Columbia'=>'DC',
        'Federated States of Micronesia'=>'FM',
        'Florida'=>'FL',
        'Georgia'=>'GA',
        'Guam'=>'GU',
        'Hawaii'=>'HI',
        'Idaho'=>'ID',
        'Illinois'=>'IL',
        'Indiana'=>'IN',
        'Iowa'=>'IA',
        'Kansas'=>'KS',
        'Kentucky'=>'KY',
        'Louisiana'=>'LA',
        'Maine'=>'ME',
        'Marshall Islands'=>'MH',
        'Maryland'=>'MD',
        'Massachusetts'=>'MA',
        'Michigan'=>'MI',
        'Minnesota'=>'MN',
        'Mississippi'=>'MS',
        'Missouri'=>'MO',
        'Montana'=>'MT',
        'Nebraska'=>'NE',
        'Nevada'=>'NV',
        'New Hampshire'=>'NH',
        'New Jersey'=>'NJ',
        'New Mexico'=>'NM',
        'New York'=>'NY',
        'North Carolina'=>'NC',
        'North Dakota'=>'ND',
        'Northern Mariana Islands'=>'MP',
        'Ohio'=>'OH',
        'Oklahoma'=>'OK',
        'Oregon'=>'OR',
        'Palau'=>'PW',
        'Pennsylvania'=>'PA',
        'Puerto Rico'=>'PR',
        'Rhode Island'=>'RI',
        'South Carolina'=>'SC',
        'South Dakota'=>'SD',
        'Tennessee'=>'TN',
        'Texas'=>'TX',
        'Utah'=>'UT',
        'Vermont'=>'VT',
        'Virgin Islands'=>'VI',
        'Virginia'=>'VA',
        'Washington'=>'WA',
        'West Virginia'=>'WV',
        'Wisconsin'=>'WI',
        'Wyoming'=>'WY',
        'Armed Forces Europe, the Middle East, and Canada'=>'AE',
        'Armed Forces Pacific'=>'AP',
        'Armed Forces Americas (except Canada)'=>'AA'
    );

    /**
     * @param $c State code
     * @return Corresponding state name or null if code is invalid.
     */
    public static function cton($c) {
        $c = strtoupper(trim($c));
        if(array_key_exists($c, self::$cton))
            return self::$cton[$c];
        else
            return null;
    }

    /**
     * @param $c State name
     * @return Corresponding state code or null if name is invalid.
     */
    public static function ntoc($n) {
        $n = ucfirst(strtolower(trim($n)));
        if(array_key_exists($n, self::$ntoc))
            return self::$ntoc[$n];
        else
            return null;
    }
}