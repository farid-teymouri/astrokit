<?php
if (!defined('ABSPATH')) {
    exit;
}


class TemplateGenerator
{
    public function generateLabel($text)
    {
        return "<label>$text</label>";
    }

    public function P($text)
    {
        return "<p>{$text}</p>";
    }

    public function H($text, $level = 1)
    {
        return "<h{$level} class=\"ui dividing header\">{$text}</h{$level}>";
    }

    public function generateInput($type, $name, $placeholder)
    {
        return "<input type=\"$type\" name=\"$name\" placeholder=\"$placeholder\">";
    }

    public function generateSelect($options)
    {
        $select = "<select class=\"ui fluid dropdown\">";
        foreach ($options as $value => $label) {
            $select .= "<option value=\"$value\">$label</option>";
        }
        $select .= "</select>";

        return $select;
    }

    public function generateCountryDropdown($countries)
    {
        $dropdown = '<div class="ui fluid search selection dropdown">';
        $dropdown .= '<input type="hidden" name="country">';
        $dropdown .= '<i class="dropdown icon"></i>';
        $dropdown .= '<div class="default text">Select Country</div>';
        $dropdown .= '<div class="menu">';

        foreach ($countries as $code => $name) {
            $dropdown .= '<div class="item" data-value="' . $name . '"><i class="' . strtolower($code) . ' flag"></i>' . $name . '</div>';
        }

        $dropdown .= '</div></div>';

        return $dropdown;
    }
    public function generateGenderDropdown($gender)
    {
        $dropdown = '<div class="ui selection dropdown">';
        $dropdown .= '<input type="hidden" name="gender">';
        $dropdown .= '<i class="dropdown icon"></i>';
        $dropdown .= '<div class="default text">Gender</div>';
        $dropdown .= '<div class="menu">';
        foreach ($gender as $code => $name) {
            $dropdown .= '<div class="item" data-value="' . $name . '">' . $name . '</div>';
        }
        $dropdown .= '</div></div>';
        return $dropdown;
    }
    public function generateCalender()
    {
        $calendar = '<div class="ui calendar" id="standard_calendar">';
        $calendar .= '<div class="ui fluid input left icon">';
        $calendar .= '<i class="calendar icon"></i>';
        $calendar .= '<input type="text" placeholder="Date/Time">';
        $calendar .= '</div></div>';
        return $calendar;
    }
    public function enqueueStylesAndScripts()
    {
        // Enqueue necessary stylesheets
        wp_enqueue_style('semantic-ui-css', ASTROKIT_PLUGIN_URI . 'assets/semantic.min.css');
        wp_enqueue_style('flags-css',  ASTROKIT_PLUGIN_URI . 'assets/flag.min.css');
        wp_enqueue_style('semantic-ui-calendar',  ASTROKIT_PLUGIN_URI . 'assets/calendar.min.css');

        // Enqueue necessary scripts
        wp_register_script('semantic-ui-js', ASTROKIT_PLUGIN_URI . 'assets/semantic.min.js', array('jquery'), ASTROKIT_VERSION, true);
        wp_register_script('semantic-ui-calendar', ASTROKIT_PLUGIN_URI . 'assets/calendar.min.js', array('semantic-ui-js'), false, true);
        wp_register_script("form-native", ASTROKIT_PLUGIN_URI . 'assets/form.js', array('semantic-ui-calendar'));
        wp_add_inline_script('form-native', 'const astrokit = ' . json_encode(array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        )), 'before');
        wp_enqueue_script('form-native');
    }
}

function astrokit_form()
{
    $templateGenerator = new TemplateGenerator();

    // call front sources
    $templateGenerator->enqueueStylesAndScripts();

    // Define shipping information
    $textFeilds = array(
        'user[full-name]' => __('Full Name', ASTROKIT),
        'user[email]' => __('Email Address', ASTROKIT),
    );

    // Define Gender options
    $GenderOptions = array('female' => "Female", 'male' => "Male");

    // Define country options
    $countryOptions = array(
        'af' => 'Afghanistan',
        'ax' => 'Aland Islands',
        'al' => 'Albania',
        'dz' => 'Algeria',
        'as' => 'American Samoa',
        'ad' => 'Andorra',
        'ao' => 'Angola',
        'ai' => 'Anguilla',
        'ag' => 'Antigua',
        'ar' => 'Argentina',
        'am' => 'Armenia',
        'aw' => 'Aruba',
        'au' => 'Australia',
        'at' => 'Austria',
        'az' => 'Azerbaijan',
        'bs' => 'Bahamas',
        'bh' => 'Bahrain',
        'bd' => 'Bangladesh',
        'bb' => 'Barbados',
        'by' => 'Belarus',
        'be' => 'Belgium',
        'bz' => 'Belize',
        'bj' => 'Benin',
        'bm' => 'Bermuda',
        'bt' => 'Bhutan',
        'bo' => 'Bolivia',
        'ba' => 'Bosnia',
        'bw' => 'Botswana',
        'bv' => 'Bouvet Island',
        'br' => 'Brazil',
        'vg' => 'British Virgin Islands',
        'bn' => 'Brunei',
        'bg' => 'Bulgaria',
        'bf' => 'Burkina Faso',
        'mm' => 'Burma',
        'bi' => 'Burundi',
        'tc' => 'Caicos Islands',
        'kh' => 'Cambodia',
        'cm' => 'Cameroon',
        'ca' => 'Canada',
        'cv' => 'Cape Verde',
        'ky' => 'Cayman Islands',
        'cf' => 'Central African Republic',
        'td' => 'Chad',
        'cl' => 'Chile',
        'cn' => 'China',
        'cx' => 'Christmas Island',
        'cc' => 'Cocos Islands',
        'co' => 'Colombia',
        'km' => 'Comoros',
        'cg' => 'Congo Brazzaville',
        'cd' => 'Congo',
        'ck' => 'Cook Islands',
        'cr' => 'Costa Rica',
        'ci' => 'Cote Divoire',
        'hr' => 'Croatia',
        'cu' => 'Cuba',
        'cy' => 'Cyprus',
        'cz' => 'Czech Republic',
        'dk' => 'Denmark',
        'dj' => 'Djibouti',
        'dm' => 'Dominica',
        'do' => 'Dominican Republic',
        'ec' => 'Ecuador',
        'eg' => 'Egypt',
        'sv' => 'El Salvador',
        'gb' => 'England',
        'gq' => 'Equatorial Guinea',
        'er' => 'Eritrea',
        'ee' => 'Estonia',
        'et' => 'Ethiopia',
        'eu' => 'European Union',
        'fk' => 'Falkland Islands',
        'fo' => 'Faroe Islands',
        'fj' => 'Fiji',
        'fi' => 'Finland',
        'fr' => 'France',
        'gf' => 'French Guiana',
        'pf' => 'French Polynesia',
        'tf' => 'French Territories',
        'ga' => 'Gabon',
        'gm' => 'Gambia',
        'ge' => 'Georgia',
        'de' => 'Germany',
        'gh' => 'Ghana',
        'gi' => 'Gibraltar',
        'gr' => 'Greece',
        'gl' => 'Greenland',
        'gd' => 'Grenada',
        'gp' => 'Guadeloupe',
        'gu' => 'Guam',
        'gt' => 'Guatemala',
        'gw' => 'Guinea-Bissau',
        'gn' => 'Guinea',
        'gy' => 'Guyana',
        'ht' => 'Haiti',
        'hm' => 'Heard Island',
        'hn' => 'Honduras',
        'hk' => 'Hong Kong',
        'hu' => 'Hungary',
        'is' => 'Iceland',
        'in' => 'India',
        'io' => 'Indian Ocean Territory',
        'id' => 'Indonesia',
        'ir' => 'Iran',
        'iq' => 'Iraq',
        'ie' => 'Ireland',
        'il' => 'Israel',
        'it' => 'Italy',
        'jm' => 'Jamaica',
        'jp' => 'Japan',
        'jo' => 'Jordan',
        'kz' => 'Kazakhstan',
        'ke' => 'Kenya',
        'ki' => 'Kiribati',
        'kw' => 'Kuwait',
        'kg' => 'Kyrgyzstan',
        'la' => 'Laos',
        'lv' => 'Latvia',
        'lb' => 'Lebanon',
        'ls' => 'Lesotho',
        'lr' => 'Liberia',
        'ly' => 'Libya',
        'li' => 'Liechtenstein',
        'lt' => 'Lithuania',
        'lu' => 'Luxembourg',
        'mo' => 'Macau',
        'mk' => 'Macedonia',
        'mg' => 'Madagascar',
        'mw' => 'Malawi',
        'my' => 'Malaysia',
        'mv' => 'Maldives',
        'ml' => 'Mali',
        'mt' => 'Malta',
        'mh' => 'Marshall Islands',
        'mq' => 'Martinique',
        'mr' => 'Mauritania',
        'mu' => 'Mauritius',
        'yt' => 'Mayotte',
        'mx' => 'Mexico',
        'fm' => 'Micronesia',
        'md' => 'Moldova',
        'mc' => 'Monaco',
        'mn' => 'Mongolia',
        'me' => 'Montenegro',
        'ms' => 'Montserrat',
        'ma' => 'Morocco',
        'mz' => 'Mozambique',
        'na' => 'Namibia',
        'nr' => 'Nauru',
        'np' => 'Nepal',
        'an' => 'Netherlands Antilles',
        'nl' => 'Netherlands',
        'nc' => 'New Caledonia',
        'pg' => 'New Guinea',
        'nz' => 'New Zealand',
        'ni' => 'Nicaragua',
        'ne' => 'Niger',
        'ng' => 'Nigeria',
        'nu' => 'Niue',
        'nf' => 'Norfolk Island',
        'kp' => 'North Korea',
        'mp' => 'Northern Mariana Islands',
        'no' => 'Norway',
        'om' => 'Oman',
        'pk' => 'Pakistan',
        'pw' => 'Palau',
        'ps' => 'Palestine',
        'pa' => 'Panama',
        'py' => 'Paraguay',
        'pe' => 'Peru',
        'ph' => 'Philippines',
        'pn' => 'Pitcairn Islands',
        'pl' => 'Poland',
        'pt' => 'Portugal',
        'pr' => 'Puerto Rico',
        'qa' => 'Qatar',
        're' => 'Reunion',
        'ro' => 'Romania',
        'ru' => 'Russia',
        'rw' => 'Rwanda',
        'sh' => 'Saint Helena',
        'kn' => 'Saint Kitts and Nevis',
        'lc' => 'Saint Lucia',
        'pm' => 'Saint Pierre',
        'vc' => 'Saint Vincent',
        'ws' => 'Samoa',
        'sm' => 'San Marino',
        'gs' => 'Sandwich Islands',
        'st' => 'Sao Tome',
        'sa' => 'Saudi Arabia',
        'sn' => 'Senegal',
        'cs' => 'Serbia',
        'rs' => 'Serbia',
        'sc' => 'Seychelles',
        'sl' => 'Sierra Leone',
        'sg' => 'Singapore',
        'sk' => 'Slovakia',
        'si' => 'Slovenia',
        'sb' => 'Solomon Islands',
        'so' => 'Somalia',
        'za' => 'South Africa',
        'kr' => 'South Korea',
        'es' => 'Spain',
        'lk' => 'Sri Lanka',
        'sd' => 'Sudan',
        'sr' => 'Suriname',
        'sj' => 'Svalbard',
        'sz' => 'Swaziland',
        'se' => 'Sweden',
        'ch' => 'Switzerland',
        'sy' => 'Syria',
        'tw' => 'Taiwan',
        'tj' => 'Tajikistan',
        'tz' => 'Tanzania',
        'th' => 'Thailand',
        'tl' => 'Timorleste',
        'tg' => 'Togo',
        'tk' => 'Tokelau',
        'to' => 'Tonga',
        'tt' => 'Trinidad',
        'tn' => 'Tunisia',
        'tr' => 'Turkey',
        'tm' => 'Turkmenistan',
        'tv' => 'Tuvalu',
        'ug' => 'Uganda',
        'ua' => 'Ukraine',
        'ae' => 'United Arab Emirates',
        'us' => 'United States',
        'uy' => 'Uruguay',
        'um' => 'Us Minor Islands',
        'vi' => 'Us Virgin Islands',
        'uz' => 'Uzbekistan',
        'vu' => 'Vanuatu',
        'va' => 'Vatican City',
        've' => 'Venezuela',
        'vn' => 'Vietnam',
        'wf' => 'Wallis and Futuna',
        'eh' => 'Western Sahara',
        'ye' => 'Yemen',
        'zm' => 'Zambia',
        'zw' => 'Zimbabwe',
    );

    ob_start();
?>
    <form class="ui segment form" style="width: fit-content;" action="javascript:void(0);">
        <div class="ui message">
            <div class="header">
                <?php echo $templateGenerator->H(__('Astrology Report Data Input', ASTROKIT), 4); ?>
            </div>
            <?php echo $templateGenerator->P(__('Please enter your birth information below to receive the best free astrological calculations.', ASTROKIT)); ?>
        </div>
        <div id="astrokit-msg"></div>
        <?php echo $templateGenerator->H(__('Personal', ASTROKIT), 4); ?>
        <div class="two fields">
            <?php foreach ($textFeilds as $name => $placeholder) : ?>
                <div class="field">
                    <?php echo $templateGenerator->generateLabel($placeholder); ?>
                    <?php echo $templateGenerator->generateInput('text', $name, $placeholder); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="two fields">
            <div class="field">
                <?php echo $templateGenerator->generateLabel('Gender'); ?>
                <?php echo $templateGenerator->generateGenderDropdown($GenderOptions); ?>
            </div>
            <div class="field">
                <?php echo $templateGenerator->generateLabel('Birthdate'); ?>
                <?php echo $templateGenerator->generateCalender(); ?>
            </div>
        </div>
        <?php echo $templateGenerator->H(__('Location', ASTROKIT), 4); ?>
        <div class="two fields">
            <div class="field">
                <?php echo $templateGenerator->generateLabel('City'); ?>
                <?php echo $templateGenerator->generateInput('text', 'city', 'Paris'); ?>
            </div>
            <div class="field">
                <?php echo $templateGenerator->generateLabel('Country'); ?>
                <?php echo $templateGenerator->generateCountryDropdown($countryOptions); ?>
            </div>
        </div>
        <button class="ui secondary button submit">
            Submit
        </button>
    </form>
<?php



    return ob_get_clean();
}

add_shortcode('astrokit', 'astrokit_form');
