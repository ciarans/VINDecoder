<?php

class VINDecoder {

    const SOUTH_AMERICA = "South America";
    const OCEANIA = "Oceania";
    const NORTH_AMERICA = "North America";
    const EUROPE = "Europe";
    const ASIA = "Asia";
    const AFRICA = "Africa";

    static protected $_regions = array(
        "A" => self::AFRICA, "B" => self::AFRICA, "C" => self::AFRICA, 
        "D" => self::AFRICA, "E" => self::AFRICA, "F" => self::AFRICA, 
        "G" => self::AFRICA, "H" => self::AFRICA, 
        "J" => self::ASIA, "K" => self::ASIA, "L" => self::ASIA, 
        "M" => self::ASIA, "N" => self::ASIA, "P" => self::ASIA, 
        "R" => self::ASIA, 
        "S" => self::EUROPE, "T" => self::EUROPE, "U" => self::EUROPE, 
        "V" => self::EUROPE, "W" => self::EUROPE, "X" => self::EUROPE, 
        "Y" => self::EUROPE, "Z" => self::EUROPE, 
        "1" => self::NORTH_AMERICA, "2" => self::NORTH_AMERICA, 
        "3" => self::NORTH_AMERICA, "4" => self::NORTH_AMERICA, 
        "5" => self::NORTH_AMERICA, 
        "6" => self::OCEANIA, "7" => self::OCEANIA, 
        "8" => self::SOUTH_AMERICA, "9" => self::SOUTH_AMERICA
    );
    
    static protected $_country_of_origin = array(
    );
    
    static protected $_manufacturers = array(
        "10T" => "Oshkosh", "11V" => "Ottawa", "137" => "AM General, Hummer", 
        "15G" => "Gillig", "17N" => "John Deere", "18X" => "WRV", 
        "19U" => "Acura", "1A4" => "Chrysler", "1A8" => "Chrysler", 
        "1AC" => "AMC", "1AM" => "AMC", "1B3" => "Dodge", "1B4" => "Dodge", 
        "1B6" => "Dodge", "1B7" => "Dodge", "1B7" => "Dodge", "1BA" => "Blue Bird", 
        "1BB" => "Blue Bird", "1BD" => "Blue Bird", "1C3" => "Chrysler", 
        "1C4" => "Chrysler", "1C8" => "Chrysler", "1C9" => "Chance", 
        "1CY" => "Crane Carrier", "1D3" => "Dodge", "1D4" => "Dodge", 
        "1D5" => "Dodge", "1D7" => "Dodge", "1D8" => "Dodge", "1EC" => "Fleetwood", 
        "1F1" => "Ford", "1F6" => "Ford", "1FA" => "Ford", "1FB" => "Ford", 
        "1FC" => "Ford", "1FD" => "Ford", "1FE" => "Ford", "1FM" => "Ford", 
        "1FT" => "Ford", "1FU" => "Freightliner", "1FV" => "Freightliner", 
        "1G1" => "Chevrolet", "1G2" => "Pontiac", "1G3" => "Oldsmobile", 
        "1G4" => "Buick", "1G5" => "GMC, Pontiac", "1G6" => "Cadillac", 
        "1G8" => "Chevrolet, Saturn", "1GA" => "Chevrolet", "1GB" => "Chevrolet", 
        "1GC" => "Chevrolet", "1GD" => "GMC", "1GE" => "Cadillac", "1GF" => "Flexible", 
        "1GG" => "Isuzu", "1GH" => "GMC, Oldsmobile", "1GJ" => "GMC", "1GK" => "GMC", 
        "1GM" => "Pontiac", "1GN" => "Chevrolet", "1GT" => "GMC", "1GY" => "Cadillac", 
        "1HG" => "Honda", "1HS" => "International", "1HT" => "International", 
        "1HV" => "International", "1J4" => "Jeep", "1J7" => "Jeep", "1J8" => "Jeep", 
        "1JC" => "AMC, Jeep", "1JD" => "AMC", "1JT" => "AMC, Jeep", "1L1" => "Lincoln", 
        "1LN" => "Lincoln", "1M1" => "Mack", "1M2" => "Mack", "1M3" => "Mack", 
        "1M8" => "MCI", "1ME" => "Mercury", "1MR" => "Lincoln", "1N4" => "Nissan", 
        "1N6" => "Datsun, Nissan", "1N9" => "Neoplan", "1NK" => "Kenworth", "1NP" => "Peterbilt", 
        "1NX" => "Toyota", "1P3" => "Plymouth", "1P4" => "Plymouth", "1P7" => "Plymouth", 
        "1P9" => "Panoz", "1RF" => "Roadmaster", "1S9" => "Saleen", "177" => "Thomas", 
        "1T8" => "Thomas", "1TU" => "TMC", "1V1" => "Volkswagen USA (commercials)", "1VW" => "Volkswagen USA (cars)", 
        "1WA" => "Autostar", "1WB" => "Autostar", "1WU" => "White Volvo", "1WV" => "Winnebago", 
        "1XK" => "Kenworth", "1XM" => "AMC", "1XP" => "Peterbilt", "1Y1" => "Chevrolet, Geo", 
        "1YV" => "Mazda", "1Z3" => "Mitsubishi", "1Z5" => "Mitsubishi", "1Z7" => "Mitsubishi", 
        "1ZV" => "Ford", "1ZW" => "Mercury", "2A3" => "Chrysler", "2A4" => "Chrysler", "2A8" => "Chrysler", 
        "2B1" => "Orion", "2B3" => "Dodge", "2B4" => "Dodge", "2B5" => "Dodge", "2B6" => "Dodge", 
        "2B7" => "Dodge", "2B8" => "Dodge", "2BC" => "AMC, Jeep", "2C1" => "Chevrolet, Geo", 
        "2C3" => "Chrysler", "2C4" => "Chrysler", "2C7" => "Pontiac", "2C8" => "Chrysler", 
        "2CC" => "AMC, Eagle", "2CK" => "Geo, Pontiac", "2CM" => "AMC", "2CN" => "Chevrolet, Geo", 
        "2D4" => "Dodge", "2D6" => "Dodge", "2D7" => "Dodge", "2D8" => "Dodge", "2E3" => "Eagle", 
        "2FA" => "Ford", "2FD" => "Ford", "2FM" => "Ford", "2FT" => "Ford", "2FU" => "Freightliner", 
        "2FV" => "Freightliner", "2FW" => "Sterling", "2FZ" => "Sterling", "2G0" => "GMC", 
        "2G1" => "Chevrolet", "2G2" => "Pontiac", "2G3" => "Oldsmobile", "2G4" => "BuickX", 
        "2G5" => "GMC", "2G7" => "Pontiac", "2G8" => "Chevrolet", "2GA" => "Chevrolet", 
        "2GB" => "Chevrolet", "2GD" => "GMC", "2GJ" => "GMC", "2GK" => "GMC", "2GN" => "Chevrolet", 
        "2GT" => "GMC", "2HG" => "Honda", "2HH" => "Acura", "2HJ" => "Honda", "2HK" => "Honda", 
        "2HM" => "Hyundai", "2HN" => "Acura", "2HS" => "International", "2HT" => "International", 
        "2J4" => "Jeep", "2LM" => "Lincoln", "2M2" => "Mack", "2ME" => "Mercury", "2MH" => "Mercury", 
        "2MR" => "Mercury", "2NK" => "Kenworth", "2NP" => "Peterbilt", "2P3" => "Plymouth", 
        "2P4" => "Plymouth", "2P5" => "Plymouth", "2P9" => "Prevost", "2PC" => "Prevost", "2S2" => "Suzuki", 
        "2S3" => "Suzuki", "2T1" => "Toyota", "2T2" => "Lexus", "2WK" => "Western Star Trucks", 
        "2WL" => "Western Star Trucks", "2XK" => "Kenworth", "2XM" => "Eagle", "2XP" => "Peterbilt", 
        "3A4" => "Chrysler", "3A8" => "Chrysler", "3AB" => "Dina", "3AL" => "Freightliner", 
        "3B3" => "Dodge", "3B4" => "Dodge", "3B6" => "Dodge", "3B7" => "Dodge", "3BK" => "Kenworth", 
        "3BP" => "Peterbilt", "3C3" => "Chrysler", "3C4" => "Chrysler", "3C8" => "Chrysler", 
        "3CA" => "Chrysler", "3D3" => "Dodge", "3D5" => "Dodge", "3D6" => "Dodge", "3D7" => "Dodge", 
        "3FA" => "Ford", "3FC" => "Ford", "3FD" => "Ford", "3FE" => "Ford, Freightliner", "3FR" => "Ford", 
        "3FT" => "Ford", "3G1" => "Chevrolet", "3G2" => "Pontiac", "3G4" => "Buick", "3G5" => "Buick", 
        "3G7" => "Pontiac", "3GB" => "Chevrolet", "3GC" => "Chevrolet", "3GD" => "GMC", "3GE" => "Chevrolet", 
        "3GK" => "GMC", "3GN" => "Chevrolet", "3GT" => "GMC", "3GY" => "Cadillac", "3HA" => "International", 
        "3HG" => "Honda", "3HM" => "Honda", "3HS" => "International", "3HT" => "International", "3LN" => "Lincoln", 
        "3MA" => "Mercury", "3ME" => "Mercury", "3N1" => "Nissan", "3NK" => "Kenworth", "3NM" => "Peterbilt", 
        "3P3" => "Plymouth", "3TM" => "Toyota", "3VW" => "Volkswagen Mexico", "3WK" => "Kenworth", "45V" => "Utilimaster", 
        "46G" => "Gillig", "49H" => "Sterling", "4A3" => "Mitsubishi", "4A4" => "Mitsubishi", "4B3" => "Dodge", 
        "4C3" => "Chrysler", "4CD" => "Oshkosh", "4DR" => "Genesis, International", "4E3" => "Eagle", "4F2" => "Mazda", 
        "4F4" => "Mazda", "4G1" => "Chevrolet", "4G2" => "Pontiac", "4GD" => "GMC", "4GT" => "Isuzu, WhiteGMC", 
        "4JG" => "Mercedes-Benz", "4KB" => "Chevrolet", "4KD" => "GMC", "4KL" => "Isuzu", "4M2" => "Mercury", 
        "4N1" => "Nissan", "4N2" => "Nissan", "4NU" => "Isuzu", "4P3" => "Plymouth", "4S1" => "Isuzu", "4S2" => "Isuzu", 
        "4S3" => "Subaru", "4S4" => "Subaru", "4S6" => "Honda", "4S7" => "Spartan", "4SL" => "Magnum", "4T1" => "Toyota", 
        "4T3" => "Toyota", "4TA" => "Toyota", "4US" => "BMW", "4UZ" => "Freightliner", "4V1" => "Volvo, WhiteGMC", 
        "4V2" => "Volvo, WhiteGMC", "4V4" => "Volvo, WhiteGMC", "4V5" => "Volvo, WhiteGMC", "4VA" => "Volvo", 
        "4VG" => "Volvo, WhiteGMC", "4VH" => "Volvo", "4VL" => "Volvo", "4VM" => "Volvo", "4VZ" => "Spartan", 
        "5AS" => "GEM", "5B4" => "Workhorse", "5CK" => "Western Star Trucks", "5FN" => "Honda", "5FY" => "New Flyer", 
        "5GA" => "Buick", "5GR" => "Hummer", "5GT" => "Hummer", "5GZ" => "Saturn", "5J6" => "Honda", "5J8" => "Acura", 
        "5KJ" => "Western Star Trucks", "5KK" => "Western Star Trucks", "5LM" => "Lincoln", "5LT" => "Lincoln", 
        "5N1" => "Nissan", "5N3" => "Infiniti", "5NM" => "Hyundai", "5NP" => "Hyundai", "5PV" => "Hino", 
        "5S3" => "Saab", "5SX" => "Amercian LeFrance", "5T4" => "Workhorse", "5TB" => "Toyota", "5TD" => "Toyota", 
        "5TE" => "Toyota", "5TF" => "Toyota", "5UM" => "BMW", "5UX" => "BMW", "5Y2" => "Pontiac", "6G2" => "Pontiac", 
        "6MM" => "Mitsubishi", "6MP" => "Mercury", "9BF" => "Ford", "9BW" => "Volkswagen Brazil", "9DW" => "Volkswagen", 
        "J81" => "Chevrolet,Geo", "J87" => "Isuzu", "J8B" => "Chevrolet", "J8D" => "GMC", "J8Z" => "Chevrolet", 
        "JA3" => "Mitsubishi", "JA4" => "Mitsubishi", "JA7" => "Mitsubishi", "JAA" => "Isuzu", "JAB" => "Isuzu", 
        "JAC" => "Isuzu", "JAE" => "Acura", "JAL" => "Isuzu", "JB3" => "Dodge", "JB4" => "Dodge", "JB7" => "Dodge", 
        "JC2" => "Ford", "JD1" => "Daihatsu", "JD2" => "Daihatsu", "JE3" => "Eagle", "JF1" => "Subaru", "JF2" => "Subaru", 
        "JF3" => "Subaru", "JF4" => "Saab", "JG1" => "Chevrolet, Geo", "JG7" => "Pontiac", "JGC" => "Geo", "JH4" => "Acura", 
        "JHB" => "Hino", "JHL" => "Honda", "JHM" => "Honda", "JJ3" => "Chrysler", "JL6" => "Mitsubishi", "JLS" => "Sterling", 
        "JM1" => "Mazda", "JM2" => "Mazda", "JM3" => "Mazda", "JN1" => "Datsun, Nissan", "JN3" => "Nissan", "JN4" => "Nissan", 
        "JN6" => "Datsun, Nissan", "JN8" => "Nissan", "JNA" => "Nissan", "JNK" => "Infiniti", "JNR" => "Infiniti", 
        "JNX" => "Infiniti", "JP3" => "Plymouth", "JP4" => "Plymouth", "JP7" => "Plymouth", "JR2X" => "Isuzu", 
        "JS2" => "Suzuki", "JS3" => "Suzuki", "JS4" => "Suzuki", "JT2" => "Toyota", "JT3" => "Toyota", "JT4" => "Toyota", 
        "JT5" => "Toyota", "JT6" => "Lexus", "JT8" => "Lexus", "JTD" => "Toyota", "JTE" => "Toyota", "JTH" => "Lexus", 
        "JTJ" => "Lexus", "JTK" => "Scion", "JTL" => "Scion", "JTM" => "Toyota", "JTN" => "Toyota", "JW6" => "Mitsubishi", 
        "JW7" => "Mitsubishi", "KL1" => "Chevrolet", "KL2" => "Pontiac", "KL5" => "Suzuki", "KL7" => "Asuna", "KLA" => "Daewoo", 
        "KM8" => "Hyundai", "KMF" => "Hyundai", "KMH" => "Hyundai", "KNA" => "Kia", "KND" => "Hyundai, Kia", "KNJ" => "Ford", 
        "KPH" => "Mitsubishi", "LES" => "Isuzu", "LM5" => "Isuzu", "ML3" => "Dodge", "SA9" => "Morgan", "SAJ" => "Jaguar", 
        "SAL" => "Land Rover", "SAT" => "Triumph", "SAX" => "Sterling", "SCA" => "Rolls-Royce", "SCB" => "Bentley", 
        "SCC" => "Lotus", "SCF" => "Aston Martin", "SDL" => "TVR Engineering", "SHH" => "Honda", "SHS" => "Honda", 
        "SJN" => "Nissan UK", "TRU" => "Audi Hungary", "VF1" => "Renault", "VF7" => "Citroën", "VF3" => "Peugeot", "VG6" => "Mack", 
        "VSS" => "Seat", "W06" => "Cadillac", "WA1" => "Audi", "WAU" => "Audi", "WBA" => "BMW", "WBS" => "BMW", "WBX" => "BMW", 
        "WD0" => "Dodge", "WD1" => "Dodge", "WD2" => "Dodge", "WD5" => "Dodge", "WD8" => "Dodge", "WDB" => "Maybach, Mercedes-Benz", 
        "WDC" => "Mercedes-Benz", "WDD" => "Mercedes-Benz", "WDP" => "Dodge", "WDX" => "Dodge", "WDY" => "Dodge", "WF1" => "Merkur", 
        "WKK" => "Fahrzeugwerke", "WME" => "Mercedes-Benz", "WMW" => "Mini", "WP0" => "Porsche", "WP1" => "Porsche", "WUA" => "Audi", 
        "WV2" => "Volkswagen Bus, Van", "WV3" => "Volkswagen Trucks", "WVG" => "Volkswagen SUVs (Gelande)", "WVW" => "Volkswagen Cars",
        "VWV" => "Volkswagen Spain", "AAV" => "Volkswagen South Africa", "8AW" => "Volkswagen Argentina",
        "WV1" => "Volkswagen Commercials", "XTA" => "Lada", "YB3" => "Volvo", "93V" => "Audi Brazil",
        "YS3" => "Saab", "YV1" => "Volvo", "YV2" => "Volvo", "YV4" => "Volvo", "YV5" => "Volvo", "ZA9" => "Lamborghini", 
        "ZAM" => "Maserati", "ZAR" => "Alfa Romeo", "ZC2" => "Chrysler", "ZFA" => "Fiat", "ZFF" => "Ferrari", "ZHWX" => "Lamborghini"
    );
    
    
    static protected $_model_years = array(
        "T" => 1996, "V" => 1997, "W" => 1998, 
        "X" => 1999, "Y" => 2000, "1" => 2001, 
        "2" => 2002, "3" => 2003, "4" => 2004, 
        "5" => 2005, "6" => 2006, "7" => 2007, 
        "8" => 2008, "9" => 2009, "A" => 2010, 
        "B" => 2011, "C" => 2012, "D" => 2013, 
        "E" => 2014, "F" => 2015, "G" => 2016, 
        "H" => 2017, "J" => 2018, "K" => 2019, 
        "L" => 2020, "M" => 2021, "N" => 2022, 
        "P" => 2023, "R" => 2024, "S" => 2025
    );
   
    static protected $_translation_values = array(
        "A" => 1, "B" => 2, "C" => 3, "D" => 4,
        "E" => 5, "F" => 6, "G" => 7, "H" => 8,
        "J" => 1, "K" => 2, "L" => 3, "M" => 4,
        "N" => 5, "P" => 7, "R" => 9, "S" => 2,
        "T" => 3, "U" => 4, "V" => 5, "W" => 6,
        "X" => 7, "Y" => 8, "Z" => 9
    );
    static protected $_weight_factors = array(
        1 => 8, 2 => 7, 3 => 6, 4 => 5,
        5 => 4, 6 => 3, 7 => 2, 8 => 10,
        9 => 0, 10 => 9, 11 => 8, 12 => 7,
        13 => 6, 14 => 5, 15 => 4, 16 => 3, 17 => 2
    );
    
    public $VIN;
    public $country_of_origin;
    public $manufacturer;
    public $vehicle_type;
    public $body_type;
    public $engine;
    public $series;
    public $restraint;
    public $model;
    public $check_digit;
    public $model_year;
    public $plant;
    public $sequential_number;

    public function __construct($vin) {
        $this->VIN = $vin;
        
        $vin = new stdClass();
        $vin->vin = $this->VIN;
        $vin->valid_checksum = $this->validate_check_digit();
        $vin->country_region = $this->get_region();
        $vin->manufacturer = $this->get_manufacturer();
        $vin->production_year = $this->get_production_year();
                
    }
    
    public function get_region(){
        $split = str_split($this->VIN);
        $region_code = $split[0];
        $region = null;
        
        echo $region_code;
        if(isset(self::$_regions[$region_code])){
            $region = self::$_regions[$region_code];
        }
        return $region;  
        
    }
    
    public function get_manufacturer(){
        $split = str_split($this->VIN);
        $wmi_prefix =  $split[0].$split[1].$split[2]; // first 3 digits
        
        $wmi = null;
        if(isset(self::$_manufacturers[$wmi_prefix])){
            $wmi = self::$_manufacturers[$wmi_prefix];
        }
        return $wmi;  
    }
    
    public function get_production_year(){
        $split = str_split($this->VIN);
        $year_code =  $split[9]; // 10th digit.
        
        $year = null;
        if(isset(self::$_model_years[$year_code])){
            $year = self::$_model_years[$year_code];
        }
        return $year;
    }
    
    public function validate_check_digit() {
        $split = str_split($this->VIN);
        
        $checksum = $split[8]; 
        $split[8] = 0; // Set 9th digit to 0 as checksum is not counted.
        
       $formatted_values = array();
       for($i = 0; $i < count($split); $i++){
           if(is_numeric($split[$i])){
               $split[$i] = (int) $split[$i];
           }else{
               $split[$i] = self::$_translation_values[$split[$i]];
           }
           $formatted_values[] = $split[$i];
       }
       
       $yield_sum = 0;
       
       for($i = 0; $i < count($formatted_values); $i++){
           $c = $i + 1;
           $v = $formatted_values[$i];
           $weight = self::$_weight_factors[$c];
           $yield_sum += ($v * $weight);
       }
       
       $generated_check_sum = $yield_sum % 11;
              
       if($generated_check_sum == $checksum){
           return true;
       }else{
           return false;
       }
       
    }
    
    
    
}
        
        
