@extends('layouts.app')

@section('title')
    Items
@endsection

@section('css')
<style>

ul {
    list-style: none;
    padding: 0;
}

li {
    min-height: 40px;
}

li span {
    display: inline-flex;
    align-items: center;
    font-weight: 400;
}

li img {
    flex-shrink: 0;
    margin-right: 8px;
}

form label {
    display: inline-flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    padding-left: 10px;
}

input[type="number"] {
    max-width: 150px;
}

input[type="number"], input[type="text"], select {
    background: rgba(0, 0, 0, 0.4);
    border: 0px none transparent;
    box-shadow: inset 0 0 2px rgba(0, 0, 0, 0.8);
    border-radius: 4px;
    /* background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.4), 0%, rgba(0, 0, 0, 0.2) 100%);
    background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.4) 0%,rgba(0, 0, 0, 0.2) 100%);
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4) 0%,rgba(0, 0, 0, 0.2) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='rgba(0, 0, 0, 0.4)', endColorstr='rgba(0, 0, 0, 0.2)',GradientType=0 ); */
    color: rgba(255, 255, 255, 0.7);
    text-shadow: 0 0 2px rgba(255, 255, 255, 0.2);

    display: inline-block;
    font-weight: 400;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
}
.search-box {
    font-weight: 400;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 1rem;
    line-height: 1.25;
    border-radius: .25rem;
    display: inline-block;
}

input[type="reset"], input[type="submit"] {
    margin-left: 8px;
}

.search {
    width: 100px;
}

.cog {
    position: relative;
    top: -48px;
}
</style>
@endsection

@section('searchoptions')
<a class="btn btn-primary btn-sm float-right mt-2 mr-2 cog" data-toggle="collapse" href="#searchControls" role="button" aria-expanded="false" aria-controls="searchControls">
    <i class="fa fa-cog"></i>
</a>
<div class="collapse pl-2 pr-2 pb-2 pt-0" id="searchControls">
    <select name='count' class="count ml-2">
            <option value='10'>10 Items</option>
            <option value='25'>25 Items</option>
            <option value='50'>50 Items</option>
            <option value='100'>100 Items</option>
            <option value='250'>250 Items</option>
    </select>
    <label id='minLevel' for="minLevel">
        <span>Min Level</span>
    </label>
    <input type='number' name='minLevel' value='' min="1" max="250" />
    
    <label id='maxLevel'>
        <span>Max Level</span>
    </label>
    <input type='number' name='maxLevel' value='' min="1" max="250" />

    <label id='job'>
        <span>Job</span>
    </label>
    <select name='job'>
        <option value=''>Any</option>
        <option value='0'>Beginner</option>
        <option value='1'>Warrior</option>
        <option value='2'>Magician</option>
        <option value='4'>Bowman</option>
        <option value='8'>Thief</option>
        <option value='16'>Pirate</option>
    </select>

    <label id='cash'>
        <span>Cash Item?</span>
    </label>
    <input type='checkbox' name='cash' />

    <div class='categoryContainer'></div>
    <input type='reset' value='Reset' class="btn btn-danger btn-sm mt-2"/>
    <input type='submit' value='Apply' class="btn btn-success btn-sm mt-2"/>
</div>
@endsection

@section('content')
<form method='get' action='/{{$region}}/{{$version}}/items'>
    <div class="justify-content-between">
        <h2 class="mb-0">
            Items
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-language"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a href='/gms/latest/items/home' class="dropdown-item">English</a> 
                <a href='/kms/latest/items/home' class="dropdown-item">한국어</a> 
                <a href='/jms/latest/items/home' class='dropdown-item'>日本語</a> 
                <a href='/cms/latest/items/home' class='dropdown-item'>中文</a>
            </div>
        </h2>
        <p class="lead">In the Maple World, the equipment and items you discover along your adventures matter. View complete details or simply preview how that shiny new <a href="/{{ $region }}/{{ $version }}/item/1302020">Maple Sword</a> looks via our wiki.</p>
    </div>
</form>

<section>
    <div class="row">
        <div class="col-md-12">
        <div class="card text-white border-primary guide-card" style="background:url('https://maplestory2.io/api/gms/latest/data/resource/image/bg/bg_henesys_a.dds') scroll top no-repeat !important; background-size:cover !important;">
                <div class="card-body" style="z-index:2;">
                    <h5 class="card-title"><i class="fa fa-star text-warning"></i> Recommended Bossing Set</h5>
                    <p class="card-text">All equipment, accessories, and items recommended for optimal bossing.</p>
                    <a href="#" class="btn btn-sm btn-primary text-white disabled">View Guide</a>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group mt-4">
        <a href="/{{$region}}/{{$version}}/items/" class="list-group-item list-group-item-action">
            View All
        </a>
    </div>
</section>
@endsection

@section('js')
<script>
/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

 ;(function($) {

  $.fn.unveil = function(threshold, callback) {

    var $w = $(window),
        th = threshold || 0,
        retina = window.devicePixelRatio > 1,
        attrib = retina? "data-src-retina" : "data-src",
        images = this,
        loaded;

    this.one("unveil", function() {
      var source = this.getAttribute(attrib);
      source = source || this.getAttribute("data-src");
      if (source) {
        this.setAttribute("src", source);
        if (typeof callback === "function") callback.call(this);
      }
    });

    function unveil() {
      var inview = images.filter(function() {
        var $e = $(this);
        if ($e.is(":hidden")) return;

        var wt = $w.scrollTop(),
            wb = wt + $w.height(),
            et = $e.offset().top,
            eb = et + $e.height();

        return eb >= wt - th && et <= wb + th;
      });

      loaded = inview.trigger("unveil");
      images = images.not(loaded);
    }

    $w.on("scroll.unveil resize.unveil lookup.unveil", unveil);

    unveil();

    return this;

  };

})(window.jQuery || window.Zepto);

$(document).ready(function() {
  $("img").unveil();
});

$(document).ready(function () {
    var itemCategories = {!! json_encode($categories) !!};
    var selectedOverallCategory = '{{ $oldQuery['overallCategory'] ?? '' }}'
    var selectedCategory = '{{ $oldQuery['category'] ?? '' }}'
    var selectedSubCategory = '{{ $oldQuery['subCategory'] ?? '' }}'

    function GenerateSelect(values, name, selected, labelText) {
        var options = []
        if (values.length)
            options = values.map(function (item) { return item.item1; })
        else
            options = Object.keys(values)

        options.splice(0, 0, '')

        var optionElements = options.map(function (option) {
            var $option = $('<option value="'+option+'">'+option+'</option>')
            if (option == selected) $option.attr('selected', 'selected')
            return $option
        })

        var selectElement = $('<select name="'+name+'" />');
        selectElement.append(optionElements)

        var labelElement = $('<label id="'+name+'" />')
        if (labelText)
            labelElement.append('<span>'+labelText+'</span>')
        labelElement.append(selectElement)

        return labelElement
    }

    var itemTypeLabel = GenerateSelect(itemCategories, 'overallCategory', selectedOverallCategory, 'Item Type')
    var itemType = itemTypeLabel.find('select'),
        $categoriesLabel = null,
        $subCategoriesLabel = null,
        $categories = null,
        $subCategories = null

    function showCategories() {
        var selectedItemType = itemType.val()
        var categories = itemCategories[selectedItemType]

        if (!categories) return

        $categoriesLabel = GenerateSelect(categories, 'category', selectedCategory, 'Category').on('change', showSubCategories)
        $categories = $categoriesLabel.find('select')
        $('#category, #subCategory').remove()
        $('#overallCategory').after($categoriesLabel)
        showSubCategories()
    }

    function showSubCategories() {
        var selectedItemType = itemType.val()
        var selectedCategory = $categories.val()
        var subCategories = itemCategories[selectedItemType][selectedCategory]

        if (!subCategories) return

        $subCategoriesLabel = GenerateSelect(subCategories, 'subCategory', selectedSubCategory, 'Sub-category')
        $subCategories = $subCategoriesLabel.find('select')
        $('#subCategory').remove()
        $('#category').after($subCategoriesLabel)
    }

    itemType.on('change', showCategories)

    $('form .categoryContainer').append(itemTypeLabel)

    showCategories()
})

</script>

    <script type="text/javascript">
        var iso = new Isotope( '.items', {
            itemSelector: '.item', // use a separate class for itemSelector, other than .col-
            layoutMode: 'masonry',
            masonry: {
            gutter: 0,
            columnWidth: '.size',
            }
        });
    </script>
@endsection