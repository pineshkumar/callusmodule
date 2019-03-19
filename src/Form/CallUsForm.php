<?php

namespace Drupal\callus\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/*
 * Configure animated scroll to top settings for this site.
 */
class CallUsForm extends ConfigFormBase {

  /**
   * Implements getEditableConfigNames().
   */
  protected function getEditableConfigNames() {
    return [
      'callus.settings',
    ];
  }

  /**
   * Implements getFormId().
   */
  public function getFormId() {
    return 'callus_form';
  }

  /**
   * Implements buildForm().
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('callus.settings');
//Button Settings
    $form['callus_custom_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Callus Button Settings'),
      '#open' => TRUE,
    ];
    $form['callus_custom_settings']['cms_phone_number'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#description' => $this->t('Call Us Phone Number Add.'),
      '#default_value' => $config->get('cms_phone_number'),
    );

    $form['callus_custom_settings']['cms_button_lable'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Button Lable'),
      '#description' => $this->t('Call Us Button Lable Custome Name'),
      '#default_value' => $config->get('cms_button_lable'),
    );
     $form['callus_custom_settings']['cms_button_side'] = array(
       '#title' => t('Button Side'),
       '#type' => 'select',
       '#description' => 'Select the Button Side.',
       // '#options' => array(t('--- SELECT ---'), t('Top'), t('Bottom')),
       '#options' => [
        1 => $this->t('right'),
        2 => $this->t('left'),
      ],
       '#default_value' => $config->get('cms_button_side'),
    );
     $form['callus_custom_settings']['cms_color_picker'] = array(
      '#type' => 'color',
      '#title' => $this->t('Choose Button Background Color'),
      '#description' => $this->t('Choose Button Background Color.'),
      '#default_value' => $config->get('cms_color_picker'),
    );
      $form['callus_custom_settings']['cms_color_font'] = array(
      '#type' => 'color',
      '#title' => $this->t('Color For Font'),
      '#description' => $this->t('Choose Font Color.'),
      '#default_value' => $config->get('cms_color_font'),
    );

//Social Button Settings
     $form['social_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Social Media settings (Optional)'),
    ];

     $form['social_settings']['cms_facebook'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Facebook'),
      '#description' => $this->t('Call Us Button For Facebook Link'),
      '#default_value' => $config->get('cms_facebook'),
    );
     $form['social_settings']['cms_gmail'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Gmail'),
      '#description' => $this->t('Call Us Button For Gmail Link'),
      '#default_value' => $config->get('cms_gmail'),
    );
     $form['social_settings']['cms_twitter'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Twitter'),
      '#description' => $this->t('Call Us Button For Twitter Link'),
      '#default_value' => $config->get('cms_twitter'),
    );
     $form['social_settings']['cms_linkedin'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Linkedin'),
      '#description' => $this->t('Call Us Button For Linkedin Link'),
      '#default_value' => $config->get('cms_linkedin'),
    );
     $form['social_settings']['cms_youtube'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Youtube'),
      '#description' => $this->t('Call Us Button For Youtube Link'),
      '#default_value' => $config->get('cms_youtube'),
    );

   return parent::buildForm($form, $form_state);
  }

  /**
   * Implement submitForm().
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $phone_number = $form_state->getValues('cms_phone_number');
    $button_lable = $form_state->getValues('cms_button_lable');
    $button_side = $form_state->getValues('cms_button_side');
    $color_picker = $form_state->getValues('cms_color_picker');
    $cms_color_font = $form_state->getValues('cms_color_font');
    // Social settings Get
    $cms_facebook = $form_state->getValues('cms_facebook');
    $cms_gmail = $form_state->getValues('cms_gmail');
    $cms_twitter = $form_state->getValues('cms_twitter');
    $cms_linkedin = $form_state->getValues('cms_linkedin');
    $cms_youtube = $form_state->getValues('cms_youtube');

    $config = $this->config('callus.settings')
      ->set('cms_phone_number', $phone_number['cms_phone_number'])
      ->set('cms_button_lable', $button_lable['cms_button_lable'])
      ->set('cms_button_side', $button_side['cms_button_side'])
      ->set('cms_color_picker', $color_picker['cms_color_picker'])
      ->set('cms_color_font', $cms_color_font['cms_color_font'])
      //Social Set
      ->set('cms_facebook', $cms_facebook['cms_facebook'])
      ->set('cms_gmail', $cms_gmail['cms_gmail'])
      ->set('cms_twitter', $cms_twitter['cms_twitter'])
      ->set('cms_linkedin', $cms_linkedin['cms_linkedin'])
      ->set('cms_youtube', $cms_youtube['cms_youtube'])
      ->save();
    parent::submitForm($form, $form_state);
  }
}
