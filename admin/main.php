<?php
function _return()
{
    class HtmlGenerator
    {
        public function H($text, $level = 1)
        {
            return "<h{$level}>{$text}</h{$level}>";
        }

        public function P($text)
        {
            return "<p>{$text}</p>";
        }

        public function Link($url, $text)
        {
            return "<a href=\"{$url}\">{$text}</a>";
        }
        public function shortcode($func)
        {
            return "[" . $func . "]";
        }
        public function dev($name, $linkedin, $github)
        {
            $name = "Astrokit Developed by : <strong>" . $name . "</strong>";
            $linkedin = "<a href=\"{$linkedin}\" target=\"_blank\">My Linkedin</a>";
            $github = "<a href=\"{$github}\" target=\"_blank\">My Github</a>";
            return "<div>" . $name . " " . $linkedin . " " . $github . "</div>";
        }
        public function generateInput($type, $name, $id)
        {
            ($_POST['submit']) ? ($_POST['dbSave'] == 'on' ? update_option('dbSave', 'on')  : update_option('dbSave', 'off')) : false;
            $checked = $type == 'checkbox' ? ($name == 'dbSave' ? (get_option('dbSave') == 'on' ? 'checked' : NULL) : NULL) : NULL;
            return "<input type=\"$type\" name=\"$name\" id=\"$id\" $checked>";
        }
        public function generateLabel($for, $text)
        {
            return "<label for=\"$for\" style=\"vertical-align: baseline;\" >$text</label>";
        }
    }

    // Usage
    $htmlGenerator = new HtmlGenerator();

    echo $htmlGenerator->dev(__('Farid Teymouri', ASTROKIT), "https://www.linkedin.com/in/farid-teymouri/", "https://github.com/farid-teymouri/");
    echo $htmlGenerator->H(__('General Option', ASTROKIT), 1);
    echo $htmlGenerator->P(__("The only necessary thing is to copy the desired shortcode and place it in a page or post.", ASTROKIT));
    echo "Shortcode => " . $htmlGenerator->shortcode("astrokit");
    echo "<form style=\"margin-top:20px\" method=\"post\">"
        . $htmlGenerator->generateInput('checkbox', 'dbSave', 'dbSave')
        . $htmlGenerator->generateLabel('dbSave', __('Save client information into database', ASTROKIT))
        . "<div style=\"margin-top:30px;\">"
        . $htmlGenerator->generateInput('submit', 'submit', 'submit')
        . "</div></form>";
}
