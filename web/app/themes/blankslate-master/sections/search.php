<?php

function search_form(){

    $locations = get_field_object('location', 'options');
    $locations_markup ='';
    foreach ($locations['choices'] as $key => $value) {
        $locations_markup .= "<option>$value</option>";
    }

    $type = get_field_object('type', 'options');
    $type_markup ='';
    foreach ($type['choices'] as $key => $value) {
        $type_markup .= "<option>$value</option>";
    }
    
 

    echo <<<SEACH
    <section class='search'>
       <div>
        <input id='searchText' />
        <button>Sök</button>
        <select id='searchType'>
            <option>Yrke</option>
            $type_markup
        </select>
        <select  id='searchLocation'>
            <option>Ort</option>
            $locations_markup
        </select>
       </div>
    </section>
    SEACH;
}
