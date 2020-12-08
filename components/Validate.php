<?php

class Validate
{
    private $errors = [], $result = false;

    public function check($data, $rules)
    {
        //нужно сравнить значение по 
        foreach ($rules as $name_rule=>$rule){
        
        $value = $data[$name_rule];

        foreach($rule as $rule_key => $rule_value)
            
            
            //проверка на requered
            if(!$value && $rule_key == 'requiered'){
                $this->errors[] = "{$name_rule} is requiered";
            } else if ($value){
                switch ($rule_key){
                    case 'max':
                        if (strlen ($value) > $rule_value){
                            $this->errors[] = "{$name_rule} must be maximum {$rule_value} simbols";
                        }
                    break;

                    case 'min':
                        if (strlen ($value) < $rule_value){
                            $this->errors[] = "{$name_rule} must be minimum {$rule_value} simbols";
                        }
                    break;

                }
            }

        }

        if(!$this->errors){
            $this->result = true;
        }
        
    }

    public function errors()
    {
        return $this->errors;
    }

    public function result()
    {
        return $this->result;
    }

}