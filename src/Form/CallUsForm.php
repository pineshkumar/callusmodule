<?php

namespace Drupal\callus\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure call us settings for this site.
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
    // Theme setting Visibility Configuration.
    $form['themename_fieldset'] = [
      '#title' => $this->t('Theme Visibility Configuration'),
      '#type' => 'fieldset',
    ];
    $form['themename_fieldset']['callus_themename'] = [
      '#title' => $this->t('Themes Name'),
      '#description' => $this->t('Call Us button add multiple themes.'),
      '#type' => 'select',
      '#multiple' => TRUE,
      '#options' => $this->getThemeName(),
      '#default_value' => $config->get('callus_themename'),
    ];
    // Form for the button setting.
    $form['callus_custom_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Callus Button Settings'),
      '#open' => TRUE,
    ];
    $form['callus_custom_settings']['cms_phone_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#description' => $this->t('Call Us Phone Number Add.'),
      '#default_value' => $config->get('cms_phone_number'),
      '#required' => TRUE,
    ];

    $form['callus_custom_settings']['cms_button_lable'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Lable'),
      '#description' => $this->t('Call Us Button Lable Custome Name'),
      '#default_value' => $config->get('cms_button_lable'),
    ];
    $form['callus_custom_settings']['cms_button_side'] = [
      '#title' => t('Button Side'),
      '#type' => 'select',
      '#description' => 'Select the Button Side.',
      '#options' => [
        1 => $this->t('Right'),
        2 => $this->t('Flot Right'),
        3 => $this->t('Left'),
      ],
      '#default_value' => $config->get('cms_button_side'),
    ];
    $form['callus_custom_settings']['cms_color_picker'] = [
      '#type' => 'color',
      '#title' => $this->t('Choose Button Background Color'),
      '#description' => $this->t('Choose Button Background Color.'),
      '#default_value' => $config->get('cms_color_picker'),
    ];
    $form['callus_custom_settings']['cms_color_font'] = [
      '#type' => 'color',
      '#title' => $this->t('Color For Font'),
      '#description' => $this->t('Choose Font Color.'),
      '#default_value' => $config->get('cms_color_font'),
    ];
    // Social Button Settings form.
    $form['social_settings'] = [
      '#type' => 'details',
      '#title' => $this->t('Social Media settings (Optional)'),
    ];
    $form['social_settings']['cms_facebook'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Facebook'),
      '#description' => $this->t('Social Button For Facebook Link. Ex: https://www.facebook.com/'),
      '#default_value' => $config->get('cms_facebook'),
    ];
    $form['social_settings']['cms_gmail'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Gmail'),
      '#description' => $this->t('Social Button For Gmail Link. Ex: https://www.google.com/'),
      '#default_value' => $config->get('cms_gmail'),
    ];
    $form['social_settings']['cms_twitter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitter'),
      '#description' => $this->t('Social Button For Twitter Link. Ex: https://www.twitter.com/'),
      '#default_value' => $config->get('cms_twitter'),
    ];
    $form['social_settings']['cms_linkedin'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Linkedin'),
      '#description' => $this->t('Social Button For Linkedin Link. Ex: https://www.linkedin.com/'),
      '#default_value' => $config->get('cms_linkedin'),
    ];
    $form['social_settings']['cms_youtube'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Youtube'),
      '#description' => $this->t('Social Button For Youtube Link. Ex: https://www.youtube.com/'),
      '#default_value' => $config->get('cms_youtube'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Implement getThemeName().
   */
  public function getThemeName() {
    $theme_handler = \Drupal::service('theme_handler');
    $themes = $theme_handler->listInfo();
    foreach ($themes as $key => $val) {
      $theme_arr[$key] = $val->info['name'];
    }
    return $theme_arr;
  }

  /**
   * Implement validateForm().
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $phone = $form_state->getValue('cms_phone_number');
    if (strlen($phone) < 10) {
      $form_state->setErrorByName('cms_phone_number', $this->t('Mobile number is too short.'));
    }
    if (strlen($phone) > 10) {
      $form_state->setErrorByName('cms_phone_number', $this->t('Mobile number is too largest.'));
    }
    if (!preg_match("/^\+?\d[0-9-]{9,12}/", $phone)) {
      $form_state->setErrorByName('cms_phone_number', $this->t('Mobile number is only numeric Valid.'));
    }
  }

  /**
   * Implement submitForm().
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Getting Value for button.
    $phone_number = $form_state->getValues('cms_phone_number');
    $button_lable = $form_state->getValues('cms_button_lable');
    $button_side = $form_state->getValues('cms_button_side');
    $color_picker = $form_state->getValues('cms_color_picker');
    $cms_color_font = $form_state->getValues('cms_color_font');
    // Social settings Get value.
    $cms_facebook = $form_state->getValues('cms_facebook');
    $cms_gmail = $form_state->getValues('cms_gmail');
    $cms_twitter = $form_state->getValues('cms_twitter');
    $cms_linkedin = $form_state->getValues('cms_linkedin');
    $cms_youtube = $form_state->getValues('cms_youtube');
    // Theme name get value.
    $callus_themename = $form_state->getValues('callus_themename');

    $config = $this->config('callus.settings')
      // Set button value setting.
      ->set('cms_phone_number', $phone_number['cms_phone_number'])
      ->set('cms_button_lable', $button_lable['cms_button_lable'])
      ->set('cms_button_side', $button_side['cms_button_side'])
      ->set('cms_color_picker', $color_picker['cms_color_picker'])
      ->set('cms_color_font', $cms_color_font['cms_color_font'])
      // Social set varible value.
      ->set('cms_facebook', $cms_facebook['cms_facebook'])
      ->set('cms_gmail', $cms_gmail['cms_gmail'])
      ->set('cms_twitter', $cms_twitter['cms_twitter'])
      ->set('cms_linkedin', $cms_linkedin['cms_linkedin'])
      ->set('cms_youtube', $cms_youtube['cms_youtube'])
      // Theme name set value.
      ->set('callus_themename', $callus_themename['callus_themename'])
      ->save();
    parent::submitForm($form, $form_state);

  }

}
