<?php

class AroundTheWorld {

  /**
   * @var array
   */
  public $cities;

  /**
   * @var array
   */
  public $messages;

  /**
   * @var int
   */
  public $circumnavigateMiles;

  /**
   * @var int
   */
  public $circumnavigateSteps;
  /**
   * Converts Steps to Miles
   *
   * @param int $steps
   * @return int
   */
  public function stepsToMiles($steps) {
    $stepsInFeet = intval($steps) * 2.5;
    return intval(round($stepsInFeet / 5280));
  }

  /**
   * Given a distance in miles, returns an object with:
   * - city index of closest
   * - string value of "almost_to" or "just_past"
   *
   * @param int $distance
   * - distance in  miles.
   * @return array
   */
  public function getClosestCity($distance) {
    $cities = $this->cities;

    $closestCityIdx = 0;
    $message = "";
    $nextCityIdx = 0;
    $previousCityIdx = 0;

    // find the first city that $distance is less than.
    for ($i = 0; $i < count($cities); $i++) {
      if ($cities[$i + 1]['distance'] > $distance) {
        $nextCityIdx = $i + 1;
        $previousCityIdx = $i;
        break;
      }
    }

    $distanceToNext = $cities[$nextCityIdx]['distance'] - $distance;
    $distanceToPrevious = $distance - $cities[$previousCityIdx]['distance'];

    if ($distanceToPrevious < $distanceToNext) {
      $closestCityIdx = $previousCityIdx;
    }
    else {
      $closestCityIdx = $nextCityIdx;
      $message = "almost_to";
    }

    if ($distanceToPrevious < 50 || $distanceToNext < 50) {
      $message = $this->messages['have_reached'];
    }
    elseif ($distanceToPrevious < $distanceToNext) {
      $message = $this->messages['just_passed'];
    }
    else {
      $message = $this->messages['almost_to'];
    }

    return [
      'distance_to_previous' => $distanceToPrevious,
      'distance_to_next' => $distanceToNext,
      'closest_city_index' => $closestCityIdx,
      'closest_city' => $cities[$closestCityIdx],
      'message' => $message,
    ];
  }

  /**
   * Gets city name of a given index.
   *
   * @param $index
   * @return mixed|null
   */
  public function getName($index) {
    if (!($index < 0) && !($index > count($this->cities))) {
      return $this->cities[$index]['name'];
    }
    else {
      return null;
    }
  }

  /**
   * Gets city distance of a given index.
   *
   * @param $index
   * @return mixed|null
   */
  public function getDistance($index) {
    if (!($index < 0) && !($index > count($this->cities))) {
      return $this->cities[$index]['distance'];
    }
    else {
      return null;
    }
  }

  /**
   * Gets google maps link of a given index.
   *
   * @param $index
   * @return mixed|null
   */
  public function getMapsLink($index) {
    if (!($index < 0) && !($index > count($this->cities))) {
      return $this->cities[$index]['maps_link'];
    }
    else {
      return null;
    }
  }

  public function __construct() {
    $this->messages = [
      'almost_to' => "are almost to",
      'have_reached' => "have reached",
      'just_passed' => "have just passed",
    ];

    $this->circumnavigateMiles = 24902;
    $this->circumnavigateSteps = intval(round((24902 * 5208) / 2.5));

    $this->cities = [
      0 => [
        "name" => "Seattle, Washington",
        "distance" => 	0,
        "maps_link" => "https://www.google.com/maps/place/Seattle,+WA/@47.6131282,-122.424464,12z/data=!3m1!4b1!4m6!3m5!1s0x5490102c93e83355:0x102565466944d59a!8m2!3d47.6061389!4d-122.3328481!16zL20vMGQ5anI?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d172139.0908878342!2d-122.34206439999998!3d47.61304199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490102c93e83355%3A0x102565466944d59a!2sSeattle%2C%20WA!5e0!3m2!1sen!2sus!4v1710698983996!5m2!1sen!2sus",
      ],
      1 => [
        "name" => "Idaho, Boise, Idaho",
        "distance" => 406,
        "maps_link" => "https://www.google.com/maps/place/Boise,+ID/@43.6007765,-116.316298,12z/data=!3m1!4b1!4m6!3m5!1s0x54aef172e947b49d:0x9a5b989b36679d9b!8m2!3d43.6150186!4d-116.2023137!16zL20vMDk5dHk?entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d92456.81444603353!2d-116.233898!3d43.60080605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54aef172e947b49d%3A0x9a5b989b36679d9b!2sBoise%2C%20ID!5e0!3m2!1sen!2sus!4v1711598812234!5m2!1sen!2sus",
      ],
      2 => [
        "name" => "Saskatoon, Canada",
        "distance" => 765,
        "maps_link" => "https://www.google.com/maps/place/Saskatoon,+SK,+Canada/@52.150063,-106.9762047,11z/data=!3m1!4b1!4m6!3m5!1s0x5304f6bf47ed992b:0x5049e3295772690!8m2!3d52.157902!4d-106.6701577!16zL20vMDE4ZDVi?entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d78339.58199201104!2d-106.6644105!3d52.150474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5304f6bf47ed992b%3A0x5049e3295772690!2sSaskatoon%2C%20SK%2C%20Canada!5e0!3m2!1sen!2sus!4v1711598906509!5m2!1sen!2sus",
      ],
      3 => [
        "name" => "Chicago, Illinois",
        "distance" => 1738,
        "maps_link" => "https://www.google.com/maps/place/Chicago,+IL/@41.8336152,-87.8967693,11z/data=!3m1!4b1!4m6!3m5!1s0x880e2c3cd0f4cbed:0xafe0a6ad09c0c000!8m2!3d41.8781136!4d-87.6297982!16zL20vMDFfZDQ?entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d190255.8460334488!2d-87.73196395!3d41.83373295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e2c3cd0f4cbed%3A0xafe0a6ad09c0c000!2sChicago%2C%20IL!5e0!3m2!1sen!2sus!4v1711598952937!5m2!1sen!2sus",
      ],
      4 => [
        "name" => "Guatemala City, Guatemala",
        "distance" => 2914,
        "maps_link" => "https://www.google.com/maps/place/Guatemala+City,+Guatemala/@14.6263716,-90.5751323,12z/data=!3m1!4b1!4m6!3m5!1s0x8589a180655c3345:0x4a72c7815b867b25!8m2!3d14.6349149!4d-90.5068824!16zL20vMDM0Nmg?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123536.74026247064!2d-90.49256045!3d14.62622005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8589a180655c3345%3A0x4a72c7815b867b25!2sGuatemala%20City%2C%20Guatemala!5e0!3m2!1sen!2sus!4v1710699013210!5m2!1sen!2sus",
      ],
      5 => [
        "name" => "Bogota, Colombia",
        "distance" =>	4113,
        "maps_link" => "https://www.google.com/maps/place/Bogot%C3%A1,+Bogota,+Colombia/@4.6484638,-74.1903789,12z/data=!3m1!4b1!4m6!3m5!1s0x8e3f9bfd2da6cb29:0x239d635520a33914!8m2!3d4.7109886!4d-74.072092!16zL20vMDFkenlj?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254508.51141489705!2d-74.107807!3d4.64829755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2sBogot%C3%A1%2C%20Bogota%2C%20Colombia!5e0!3m2!1sen!2sus!4v1710698855463!5m2!1sen!2sus",
      ],
      6 => [
        "name" => "London, England",
        "distance" =>	4798,
        "maps_link" => "https://www.google.com/maps/place/London,+UK/@51.5287393,-0.2667442,11z/data=!3m1!4b1!4m6!3m5!1s0x47d8a00baf21de75:0x52963a5addd52a99!8m2!3d51.5072178!4d-0.1275862!16zL20vMDRqcGw?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.182370726!2d-0.10159865000000001!3d51.52864165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2sus!4v1710698884990!5m2!1sen!2sus",
      ],
      7 => [
        "name" => "Lima, Peru",
        "distance" =>	4963,
        "maps_link" => "https://www.google.com/maps/place/Lima,+Peru/@-12.026254,-77.152928,11z/data=!3m1!4b1!4m6!3m5!1s0x9105c5f619ee3ec7:0x14206cb9cc452e4a!8m2!3d-12.0463731!4d-77.042754!16zL20vMGxwZmg?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d249743.68803786347!2d-76.98777915!3d-12.0266383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c5f619ee3ec7%3A0x14206cb9cc452e4a!2sLima%2C%20Peru!5e0!3m2!1sen!2sus!4v1710698937863!5m2!1sen!2sus",
      ],
      8 => [
        "name" => "Madrid, Spain",
        "distance" =>	5302,
        "maps_link" => "https://www.google.com/maps/place/Madrid,+Spain/@40.4377978,-3.9909865,11z/data=!3m1!4b1!4m6!3m5!1s0xd422997800a3c81:0xc436dec1618c2269!8m2!3d40.4167754!4d-3.7037902!16zL20vMDU2X3k?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d194347.89542910652!2d-3.67953665!3d40.4379543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid%2C%20Spain!5e0!3m2!1sen!2sus!4v1710698960024!5m2!1sen!2sus",
      ],
      9 => [
        "name" => "Algiers, Algeria",
        "distance" =>	5719,
        "maps_link" => "https://www.google.com/maps/place/Algiers+Province,+Algeria/@36.6968262,2.9270729,11z/data=!3m1!4b1!4m6!3m5!1s0x128e521f646e1edb:0x35c0e93b4118c15d!8m2!3d36.6997294!4d3.0576199!16zL20vMGg3X3Jo?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d204740.98828777502!2d3.0922204!3d36.696664899999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128e521f646e1edb%3A0x35c0e93b4118c15d!2sAlgiers%20Province%2C%20Algeria!5e0!3m2!1sen!2sus!4v1710699064125!5m2!1sen!2sus",
      ],
      10 => [
        "name" => "Cairo, Egypt",
        "distance" =>	6840,
        "maps_link" => "https://www.google.com/maps/place/Cairo,+Cairo+Governorate,+Egypt/@30.0595563,31.2171792,13z/data=!3m1!4b1!4m6!3m5!1s0x14583fa60b21beeb:0x79dfb296e8423bba!8m2!3d30.0444196!4d31.2357116!16zL20vMDF3MnY?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55251.37451031098!2d31.258464350000004!3d30.059488450000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fa60b21beeb%3A0x79dfb296e8423bba!2sCairo%2C%20Cairo%20Governorate%2C%20Egypt!5e0!3m2!1sen!2sus!4v1710699091638!5m2!1sen!2sus",
      ],
      11 => [
        "name" => "Mumbai, India",
        "distance" =>	7734,
        "maps_link" => "https://www.google.com/maps/place/Mumbai,+Maharashtra,+India/@19.0823946,72.7986144,12z/data=!3m1!4b1!4m6!3m5!1s0x3be7c6306644edc1:0x5da4ed8f8d648c69!8m2!3d19.0759837!4d72.8776559!16zL20vMDR2bXA?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241317.03900799053!2d72.88118615!3d19.082250749999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra%2C%20India!5e0!3m2!1sen!2sus!4v1710699143146!5m2!1sen!2sus",
      ],
      12 => [
        "name" => "McMurdo, Antarctica",
        "distance" =>	9165,
        "maps_link" => "https://www.google.com/maps/place/McMurdo+Station,+Antarctica/@-77.8400989,166.6058841,13z/data=!3m1!4b1!4m6!3m5!1s0xaf773973ada5b34d:0xe241f2716549c551!8m2!3d-77.8455159!4d166.6697691!16s%2Fg%2F1ynnq2s0k?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26893.31584587391!2d166.68373329999997!3d-77.8401279!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xaf773973ada5b34d%3A0xe241f2716549c551!2sMcMurdo%20Station%2C%20Antarctica!5e0!3m2!1sen!2sus!4v1710699165356!5m2!1sen!2sus",
      ],
      13 => [
        "name" => "Johannesburg, South Africa",
        "distance" =>	10255,
        "maps_link" => "https://www.google.com/maps/place/Johannesburg,+South+Africa/@-26.1713439,27.9574531,12z/data=!3m1!4b1!4m6!3m5!1s0x1e950c68f0406a51:0x238ac9d9b1d34041!8m2!3d-26.2041028!4d28.0473051!16zL20vMGcyODQ?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114584.73585386139!2d28.04002455!3d-26.1715215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e950c68f0406a51%3A0x238ac9d9b1d34041!2sJohannesburg%2C%20South%20Africa!5e0!3m2!1sen!2sus!4v1710699185438!5m2!1sen!2sus",
      ],
      14 => [
        "name" => "Jakarta, Indonesia",
        "distance" =>	16527,
        "maps_link" => "https://www.google.com/maps/place/Jakarta,+Indonesia/@-6.2295694,106.7469462,12z/data=!3m1!4b1!4m6!3m5!1s0x2e69f3e945e34b9d:0x5371bf0fdad786a2!8m2!3d-6.1944491!4d106.8229198!16zL20vMDQ0cnY?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.478949799!2d106.829518!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1710699207580!5m2!1sen!2sus",
      ],
      15 => [
        "name" => "Sydney, Australia",
        "distance" =>	17163,
        "maps_link" => "https://www.google.com/maps/place/Sydney+NSW,+Australia/@-33.8472332,150.6016643,10z/data=!3m1!4b1!4m6!3m5!1s0x6b129838f39a743f:0x3017d681632a850!8m2!3d-33.8688197!4d151.2092955!16zL20vMDZ5NTc?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d424141.6978944982!2d150.93197474999997!3d-33.84824395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b129838f39a743f%3A0x3017d681632a850!2sSydney%20NSW%2C%20Australia!5e0!3m2!1sen!2sus!4v1710699234436!5m2!1sen!2sus",
      ],
      16 => [
        "name" => "Beijing, China",
        "distance" =>	19489,
        "maps_link" => "https://www.google.com/maps/place/Beijing,+China/@39.9389417,116.0671471,10z/data=!3m1!4b1!4m6!3m5!1s0x35f05296e7142cb9:0xb9625620af0fa98a!8m2!3d39.904211!4d116.407395!16zL20vMDE5MTQ?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d391566.3391962266!2d116.39745889999999!3d39.9388838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35f05296e7142cb9%3A0xb9625620af0fa98a!2sBeijing%2C%20China!5e0!3m2!1sen!2sus!4v1710699287608!5m2!1sen!2sus",
      ],
      17 => [
        "name" => "Christmas Island, Kiribati",
        "distance" =>	21120,
        "maps_link" => "https://www.google.com/maps/place/Christmas+Island/@-10.4924282,105.5824349,13z/data=!3m1!4b1!4m6!3m5!1s0x2ef59a27e3c0a7cf:0x15e7d6090475ea16!8m2!3d-10.447525!4d105.690449!16zL20vMDFwNWw?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125539.30852970808!2d105.6237201!3d-10.492515299999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2ef59a27e3c0a7cf%3A0x15e7d6090475ea16!2sChristmas%20Island!5e0!3m2!1sen!2sus!4v1710699309686!5m2!1sen!2sus",
      ],
      18 => [
        "name" => "Anchorage, Alaska",
        "distance" => 	23466,
        "maps_link" => "https://www.google.com/maps/place/Anchorage,+AK/@61.1079169,-150.1009425,9z/data=!3m1!4b1!4m6!3m5!1s0x56c8917604b33f41:0x257dba5aa78468e3!8m2!3d61.2175758!4d-149.8996784!16zL20vMGdfd24y?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d493483.1300342918!2d-149.44031090000001!3d61.10886444999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x56c8917604b33f41%3A0x257dba5aa78468e3!2sAnchorage%2C%20AK!5e0!3m2!1sen!2sus!4v1710699331388!5m2!1sen!2sus",
      ],
      19 => [
        "name" => "Seattle, Washington",
        "distance" => 	24902,
        "maps_link" => "https://www.google.com/maps/place/Seattle,+WA/@47.6131282,-122.424464,12z/data=!3m1!4b1!4m6!3m5!1s0x5490102c93e83355:0x102565466944d59a!8m2!3d47.6061389!4d-122.3328481!16zL20vMGQ5anI?hl=en&entry=ttu",
        "embed_link" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d172139.0908878342!2d-122.34206439999998!3d47.61304199999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5490102c93e83355%3A0x102565466944d59a!2sSeattle%2C%20WA!5e0!3m2!1sen!2sus!4v1710698983996!5m2!1sen!2sus",
      ],
    ];
  }

}