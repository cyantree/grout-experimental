<?php
namespace Cyantree\Grout\Ui;

use Cyantree\Grout\Constraints\FileConstraint;
use Cyantree\Grout\Tools\ArrayTools;
use Cyantree\Grout\Ui\Ui;
use Cyantree\Grout\Constraints\TextConstraint;

class ConstraintUi extends Ui
{
    public function constraintTextInput(TextConstraint $constraint, $parameters = null)
    {
        $defaultParameters = array('error' => $constraint->hasError, 'required' => !!$constraint->minLength && ArrayTools::get($parameters, 'required') !== false);

        if ($parameters !== null) {
            $parameters = array_merge($defaultParameters, $parameters);

        } else {
            $parameters = &$defaultParameters;
        }


        return $this->textInput($constraint->name, $constraint->value, $constraint->maxLength, $parameters);
    }

    public function constraintHiddenInput(TextConstraint $constraint, $parameters = null)
    {
        return $this->hiddenInput($constraint->name, $constraint->value, $parameters);
    }

    public function constraintTextArea(TextConstraint $constraint, $parameters = null)
    {
        $defaultParameters = array('error' => $constraint->hasError, 'required' => !!$constraint->minLength && ArrayTools::get($parameters, 'required') !== false);

        if ($parameters !== null) {
            $parameters = array_merge($defaultParameters, $parameters);

        } else {
            $parameters = &$defaultParameters;
        }


        return $this->textArea($constraint->name, $constraint->value, $parameters);
    }

    public function constraintEmail(TextConstraint $constraint, $parameters = null)
    {
        $defaultParameters = array('type' => 'email');

        if ($parameters !== null) {
            $parameters = array_merge($defaultParameters, $parameters);

        } else {
            $parameters = &$defaultParameters;
        }

        return $this->constraintTextInput($constraint, $parameters);
    }

    public function constraintUrl(TextConstraint $constraint, $parameters = null)
    {
        $defaultParameters = array('type' => 'url');

        if ($parameters !== null) {
            $parameters = array_merge($defaultParameters, $parameters);

        } else {
            $parameters = &$defaultParameters;
        }

        return $this->constraintTextInput($constraint, $parameters);
    }

    public function constraintPassword(TextConstraint $constraint, $parameters = null)
    {
        $defaultParameters = array('error' => $constraint->hasError, 'required' => !!$constraint->minLength && ArrayTools::get($parameters, 'required') !== false);

        if ($parameters !== null) {
            $parameters = array_merge($defaultParameters, $parameters);

        } else {
            $parameters = &$defaultParameters;
        }


        return $this->passwordInput($constraint->name, $constraint->maxLength, $parameters);
    }


    public function constraintFileInput(FileConstraint $constraint, $parameters = null)
    {
        $defaultParameters = array('error' => $constraint->hasError, 'required' => $constraint->required && ArrayTools::get($parameters, 'required') !== false);

        if ($parameters !== null) {
            $parameters = array_merge($defaultParameters, $parameters);

        } else {
            $parameters = &$defaultParameters;
        }


        return $this->fileInput($constraint->name, ArrayTools::get($parameters, 'accept'), $parameters);
    }
}