@if(!empty(request()->get('menu')))
<div id="accordion-left">
    @include('cmxperts::menu.accordions.add-link', ['name' => 'Add Link'])

    @include('cmxperts::menu.accordions.add-separator', ['name' => 'Add Separator'])
</div>
@endif
