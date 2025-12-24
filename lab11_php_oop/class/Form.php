<?php
class Form
{
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;

    public function __construct($action = "", $submit = "Simpan")
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function displayForm()
    {
        echo "<form action='" . $this->action . "' method='POST'>";
        echo '<table width="100%" border="0">';

        foreach ($this->fields as $field) {
            echo "<tr><td align='right' valign='top' style='padding:8px; width:180px;'>" . $field['label'] . "</td>";
            echo "<td style='padding:8px;'>";

            switch ($field['type']) {

                case 'textarea':
                    echo "<textarea name='" . $field['name'] . "' cols='50' rows='6'></textarea>";
                    break;

                case 'select':
                    echo "<select name='" . $field['name'] . "'>";
                    foreach ($field['options'] as $value => $label) {
                        echo "<option value='" . $value . "'>" . $label . "</option>";
                    }
                    echo "</select>";
                    break;

                case 'radio':
                    foreach ($field['options'] as $value => $label) {
                        echo "<label style='margin-right:10px;'>
                                <input type='radio' name='" . $field['name'] . "' value='" . $value . "'> 
                                " . $label . "
                              </label>";
                    }
                    break;

                case 'checkbox':
                    foreach ($field['options'] as $value => $label) {
                        echo "<label style='margin-right:10px;'>
                                <input type='checkbox' name='" . $field['name'] . "[]' value='" . $value . "'> 
                                " . $label . "
                              </label>";
                    }
                    break;

                case 'password':
                    echo "<input type='password' name='" . $field['name'] . "'>";
                    break;

                default:
                    echo "<input type='text' name='" . $field['name'] . "'>";
                    break;
            }

            echo "</td></tr>";
        }

        echo "<tr><td colspan='2' style='padding:8px;'>
                <input type='submit' value='" . $this->submit . "'>
              </td></tr>";
        echo "</table>";
        echo "</form>";
    }

    public function addField($name, $label, $type = "text", $options = array())
    {
        $this->fields[$this->jumField] = [
            'name' => $name,
            'label' => $label,
            'type' => $type,
            'options' => $options
        ];

        $this->jumField++;
    }
}
