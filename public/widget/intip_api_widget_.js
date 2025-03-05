const script = {};
const base_url = 'https://appt.demoo.id/intip_solo/';
const regex = /^https\:\/\/appt\.demoo\.id\/intip_solo\/widget\/intip_api_widget\.js/g;
async function init() {
    //set container
    const container = document.getElementById('intip_api_widget');
    //get all config
    let regex = /^intip-/g;
    let jquery = {},
        datatable = {},
        head = document.querySelector('head');
    script.dom = document.querySelector('script[src="' + script.src + '"]'),

        Object.keys(container.attributes).map(v => {
            // config not style
            if (container.attributes[v].name.match(regex)) {
                let key = container.attributes[v].name.slice(6);
                let value = container.attributes[v].value
                switch (key) {
                    case 'jquery':
                        if (value == 'true') {
                            let jq = document.createElement('script');
                            jq.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js';
                            jquery = jq;
                        } else {
                            jquery = null;
                        }
                        break;
                    case 'datatable':
                        if (value == 'true') {
                            let datatable_js = document.createElement('script');
                            datatable_js.src = 'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js';
                            let datatable_css = document.createElement('link');
                            datatable_css.rel = 'stylesheet';
                            datatable_css.href = 'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css'
                            datatable.js = datatable_js;
                            datatable.css = datatable_css;
                        } else {
                            datatable.js = null;
                            datatable.css = null;
                        }
                        break;
                    default: container.style[key] = value;
                }

            }
        })

    let loader = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;background:#fff;display:inline-block;" width="64px" height="64px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><rect x="11.5" y="11.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0s" calcMode="discrete"></animate></rect><rect x="37.5" y="11.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.12254901960784313s" calcMode="discrete"></animate></rect><rect x="63.5" y="11.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.24509803921568626s" calcMode="discrete"></animate></rect><rect x="11.5" y="37.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.8578431372549019s" calcMode="discrete"></animate></rect><rect x="63.5" y="37.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.3676470588235294s" calcMode="discrete"></animate></rect><rect x="11.5" y="63.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.7352941176470588s" calcMode="discrete"></animate></rect><rect x="37.5" y="63.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.6127450980392157s" calcMode="discrete"></animate></rect><rect x="63.5" y="63.5" width="25" height="25" fill="#e15b64"><animate attributeName="fill" values="#ffffff;#e15b64;#e15b64" keyTimes="0;0.125;1" dur="0.9803921568627451s" repeatCount="indefinite" begin="0.49019607843137253s" calcMode="discrete"></animate></rect></svg>';

    let add_datatable = () => {

        let init_datatable = () => {
            $('#intip_layer_table').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: base_url + 'get_api/layers_datatable',
                    type: 'POST',
                    data: (data)=>{
                        data.access_token = script.access_token;
                    }
                },
                scrollX: true,
                searchDelay: 2000,
                order: [],
                language: {
                    processing: '<span>' + loader + '</span>',
                    search: '',
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ layer",
                    infoFiltered: 'yang cocok ( total _MAX_ layer )',
                    infoEmpty: 'Menampilkan 0 dari 0 layer',
                    zeroRecords: 'Tidak ada layer untuk ditampilkan.',
                    lengthMenu: '<select><option value="10">10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="100">100</option></select>',
                    paginate: {
                        previous: '<<',
                        next: '>>'
                    }
                },
                columnDefs: [
                    {
                        targets: [0],
                        orderable: false,
                        width: '10px'
                    }
                ]
            });
            $('#intip_layer_table .dataTables_processing').css({ "display": "block", "z-index": 10000 })
            $('#intip_layer_table').on('change', '[type="checkbox"]', function () {
                $('.dataTables_processing').show();
                fetch(base_url + 'get_api/set_layer', {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_layer: $(this).attr('id'),
                        checked: $(this).is(':checked'),
                        access_token: script.access_token
                    })
                })
                    .then(res => {
                        res.json()
                            .then(r => {
                                if (r.status == 'success') {
                                    $('.dataTables_processing').hide();
                                } else {
                                    $('.dataTables_processing').hide();
                                    alert(r.message);
                                }
                            })

                    })

                
            })
        }

        if (datatable.js != null) {
            datatable.js.onload = () => {
                init_datatable();
            };
            script.dom.before(datatable.js);
            head.append(datatable.css);
        } else {
            setTimeout(()=>init_datatable(),5000);
        }
    }

    if (jquery != null) {
        jquery.onload = () => {
            add_datatable();
            create();
        };
        script.dom.before(jquery);
    } else {
        add_datatable();
        create();
    }

}

async function create() {
    const container = $('#intip_api_widget');
    let title = '<h3 style="color: #878787">INTIP API Widget</h3>';
    let api_url = '<div style="color: #1f96dc; margin-bottom: 20px">API Link: '+script.access_api_url+'<div>';
    let table = '';
    table += '<table id="intip_layer_table" width="100%">';
    table += '<thead>';
    table += '<th></th>';
    table += '<th>Nama Layer</th>';
    table += '<th>Grup</th>';
    table += '<th>Jenis</th>';
    table += '<th>OPD</th>';
    table += '</thead>';
    table += '<tbody></tbody>';
    table += '</table>';
    container.append(title);
    container.append(api_url);
    container.append(table);
}

function auth() {
    let script_collection = document.getElementsByTagName('script');
    for (let i = 0; i < script_collection.length; i++) {
        if (script_collection[i].src.match(regex)) {
            let split_script = script_collection[i].src.split('?');
            script.src = script_collection[i].src;
            script.access_token = split_script[1].split('=')[1];
        }
    }
    //access auth
    fetch(base_url + 'get_api/auth', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            href: window.location.href,
            access_token: script.access_token
        })
    })
        .then(res => {
            res.json()
                .then(r => {
                    if (r.status == 'success') {
                        script.access_api_url = r.access_api_url;
                        init();
                    } else {
                        alert(r.message);
                    }
                })

        })
} auth();


