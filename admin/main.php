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
    }

    // Usage
    $htmlGenerator = new HtmlGenerator();

    echo $htmlGenerator->dev('farid teymouri', "#", "#");
    echo $htmlGenerator->H('General Option', 1);
    echo $htmlGenerator->P("The only necessary thing is to copy the desired shortcode and place it in a page or post.");
    echo "Shortcode => " . $htmlGenerator->shortcode("astrokit");
}
