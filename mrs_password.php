<?php
namespace app\MrsUI;

use std, gui, framework, app;

class mrs_password 
{
    var $pass;
    var $isKeyLose;
    public function Mrs_password_show($title,$txt,$Animation_show)
    {
        //Mrs_alert
        $form = new UXForm();
        $form->centerOnScreen();//Оцентровать по середине
        $form->modality = 'APPLICATION_MODAL';
        $form->layout->size = [448,304];
        $form->style = 'TRANSPARENT';
        $form->layout->backgroundColor = 'transparent';
        $form->transparent = true;
        $form->title = $title;
        //end settings
        $background = new UXRectangle();
        $background->size = [400,256];
        $background->position = [24,24];
        $background->fillColor = 'white';
        $background->focusTraversable = false;
        //buttonMove
        $move = new UXMaterialButton();
        $move->position = [24,24];
        $move->size = [400,32];
        $move->focusTraversable = false;
        $move->text = $title;
        //buttonApply
        $buttonApply = new UXMaterialButton();
        $buttonApply->position = [384,24];
        $buttonApply->size = [32,32];
        $buttonApply->focusTraversable = false;
        $buttonApply->backgroundColor = '#ccffcc';
        $buttonApply->text = 'Ok';
        //text
        $text = new UXLabel();
        $text->position = [24,56];
        $text->size = [400,224];
        $text->text = $txt;
        $text->alignment = 'TOP_LEFT';
        $text->wrapText = true;
        //password_Field
        $password = new UXPasswordField();
        $password->position = [24,248];
        $password->size = [400,32];
        $password->focusTraversable = false;
        $password->promptText = 'Введите пароль...';
        //shadow(background)
        $Shadow = new DropShadowEffectBehaviour();
        $Shadow->apply($background);//Add background
        //moveEffect
        $move_ = new DraggingFormBehaviour();
        $move_->opacityEnabled = true;
        $move_->apply($move);
        //ограничение символов -> !
        if($this->isKeyLose)//Iskeylose :)
        {
            $keylose = new KeyInputRuleBehaviour();
            $keylose->allowedSymbols = '1234567890_-zaqxswcdevfrbgtnhymjukilopяфйчыцсвумакипетрньогблшюдщжзэхъ';//Типо какие символы возможно использовать )
            $keylose->apply($password);//ApLyA
        }
        //Event
        $buttonApply->on('click', function () use ($form,$password) 
        {
            if($password->text == $this->pass)
            {
                UXDialog::showAndWait('Успешна!','INFORMATION');
                $form->hide();
                $password->text = null;
            }
            else
            {
                UXDialog::showAndWait('Введен не верный пароль!','ERROR');
                $password->text = null;
            }
        });
        //add component
        $form->add($background);
        $form->add($move);
        $form->add($buttonApply);
        $form->add($text);
        $form->add($password);
        //showing
        if($Animation_show == true)
        {
            $time = 2000;//use time add
            $form->opacity = 0; // делаем её прозрачной
            Animation::fadeIn($form, $time);
        }
        $form->showAndWait();//Create Форм типа создать форму ))0
    }
}
