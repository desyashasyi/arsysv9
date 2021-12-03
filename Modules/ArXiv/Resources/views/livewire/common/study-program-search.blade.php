    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<div>
    <select class="selectpicker" data-show-subtext="true" data-live-search="true">
        <option data-tokens="name">name</option>
        <option data-tokens="family">family</option>
    </select>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('message.received', (message, component) => {
                $('select').selectpicker('destroy');
            })
        });

        window.addEventListener('contentChanged', event => {
            $('select').selectpicker();
            console.log('test');
        });
    </script>
</div>
