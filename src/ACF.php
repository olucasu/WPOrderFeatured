<?php
namespace WPOrderFeatured;

class ACF 
{

  public static $acf_post_is_featured = 'field_57cd780e5ac23';
  public static $acf_position = 'field_5a58d70aeb9b5';

  public static function config($postType = 'post')
  {
    if( function_exists('acf_add_local_field_group')) 
    {
      acf_add_local_field_group(array (
        'key' => 'group_57cd780056236',
        'title' => 'Opções de Destaque',
        'fields' => array (
          array (
            'key' => self::$acf_post_is_featured,
            'label' => 'Exibir esta notícia no destaque?',
            'name' => 'is_slide_destaque',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array (
              'sim' => 'Sim',
              'nao' => 'Não',
            ),
            'allow_null' => 0,
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => 'nao',
            'layout' => 'horizontal',
            'return_format' => 'value',
          ),
          array (
            'key' => self::$acf_position,
            'label' => 'Selecione a posição',
            'name' => 'posicao_destaque',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => array (
              array (
                array (
                  'field' => 'field_57cd780e5ac23',
                  'operator' => '==',
                  'value' => 'sim',
                ),
              ),
            ),
            'wrapper' => array (
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'choices' => array (
              1 => '[Slide] Posição 1',
              2 => '[Slide] Posição 2',
              3 => '[Slide] Posição 3',
              4 => '[Card] Posição 4',
              5 => '[Card] Posição 5',
              6 => '[Card] Posição 6',
              7 => '[Card] Posição 7',
            ),
            'default_value' => '',
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
          ),
        ),
        'location' => array (
          array (
            array (
              'param' => 'post_type',
              'operator' => '==',
              'value' => $postType,
            ),
          ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
      ));
    }
  }
}
