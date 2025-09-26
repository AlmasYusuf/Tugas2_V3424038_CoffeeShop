<?php
class Form {
    private $form;

    public function __construct($action = "", $method = "POST") {
        $this->form = "<form action='$action' method='$method'>";
    }

    public function text($name, $label) {
        $this->form .= "<label>$label</label><br>
                        <input type='text' name='$name' required><br><br>";
    }

    public function password($name, $label) {
        $this->form .= "<label>$label</label><br>
                        <input type='password' name='$name' required><br><br>";
    }

    public function radio($name, $label, $options = []) {
        $this->form .= "<label>$label</label><br>";
        foreach ($options as $value) {
            $this->form .= "<input type='radio' name='$name' value='$value' required> $value ";
        }
        $this->form .= "<br><br>";
    }

    public function checkbox($name, $label, $options = []) {
        $this->form .= "<label>$label</label><br>";
        foreach ($options as $value) {
            $this->form .= "<input type='checkbox' name='{$name}[]' value='$value'> $value ";
        }
        $this->form .= "<br><br>";
    }

    public function select($name, $label, $options = []) {
        $this->form .= "<label>$label</label><br>
                        <select name='$name' required>";
        foreach ($options as $value) {
            $this->form .= "<option value='$value'>$value</option>";
        }
        $this->form .= "</select><br><br>";
    }

    public function textarea($name, $label) {
        $this->form .= "<label>$label</label><br>
                        <textarea name='$name' rows='4' cols='50'></textarea><br><br>";
    }

    public function submit($value = "Submit") {
        $this->form .= "<input type='submit' name='submit' value='$value'>";
    }

    public function end() {
        $this->form .= "</form>";
        return $this->form;
    }
}
?>