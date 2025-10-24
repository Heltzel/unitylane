<?php

/**
 * Plugin Name: Forminator Remember Session
 * Description: Houdt Forminator formulierwaarden tijdelijk bij in sessionStorage zodat velden gevuld blijven bij back/reload. Leeg bij sluiten browser.
 * Version: 1.0
 * Author: Heltson
 */

if (!defined('ABSPATH')) exit;

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('jquery');

	wp_add_inline_script('jquery', "
        jQuery(document).ready(function($){
            // Selecteer alle Forminator formulieren
            $('.forminator-ui').each(function(){
                const form = $(this);
                const formId = form.attr('id'); // bijvoorbeeld 'forminator-module-942'
                const storageKey = 'forminator_saved_' + formId;

                // --- 1. Sla wijzigingen op in sessionStorage
                form.on('input change', 'input, textarea, select', function(){
                    let saved = JSON.parse(sessionStorage.getItem(storageKey)) || {};
                    saved[this.name] = $(this).val();
                    sessionStorage.setItem(storageKey, JSON.stringify(saved));
                });

                // --- 2. Herstel data bij pagina load
                let saved = JSON.parse(sessionStorage.getItem(storageKey)) || {};
                for(let key in saved){
                    form.find('[name=\"' + key + '\"]').val(saved[key]);
                }
            });
        });
    ");
});
