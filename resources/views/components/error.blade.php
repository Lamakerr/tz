@php
    $name=$attributes->get('name');
@endphp
@error($name)
            <div >
                {{$message}}
            </div>               
@enderror