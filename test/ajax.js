$(document).ready(function () {
    function createtable(tableid) {
        let table = `<table id="` + tableid + `" border="1">
            <thead>
                <tr><th>Id</th><th>Message</th><th>Created At</th></tr>
            </thead>
            <tbody class="tablebody"></tbody>
            <tfoot>
                <tr><th>Id</th><th>Message</th><th>Created At</th></tr>
            </tfoot>
        </table>`;
        return table;
    }
    myajax('get-data.php', function (dataJSON) {
        let data = JSON.parse(dataJSON);
        if (data.length > 0) {
            $('#root').html(
                createtable('datatable')
            );
            let td = "<tr>";
            for (let i = 0; i < data.length; i++) {
                const element = data[i];
                for (const key in element) {
                    if (element.hasOwnProperty.call(element, key)) {
                        const value = element[key];
                        td = td + "<td>" + value + "</td>";
                    }
                }
                td = td + "</tr>";
            }
            $('#datatable .tablebody').html(td);
        } else {
            $('#root').html(
                '<h1>No Data Exist</h1>'
            );
        }
    });
    $('form').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        console.log('send');
        if ($("input").val() == '') {
            $("input").val(Math.floor(Math.random() * 100));
        }
        myajax('insert-data.php', function (insertJSON) {
            let insert = JSON.parse(insertJSON);
            if (insert) {
                myajax('lastdata.php', function (dataJSON) {
                    let lastdata = JSON.parse(dataJSON);
                    $('#datatable tbody tr:last').after('<tr><td>' + lastdata[0].id + '</td><td>' + lastdata[0].msg + '</td><td>' + lastdata[0].created_at + '</td></tr>');
                });
            }
        }, form.serialize());
    });
    function myajax(url, work, data = '') {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (data) {
                work(data);
            }
        });
        return work;
    }
    setInterval(function () {
        myajax('checkdb.php', function (data) {
            let oldDtat = sessionStorage.getItem('oldid');
            if (oldDtat < data) {
                sessionStorage.setItem('oldid', data);
                myajax('lastdata.php', function (dataJSON) {
                    let autodata = JSON.parse(dataJSON);
                    $('#datatable tbody tr:last').after('<tr><td>' + autodata[0].id + '</td><td>' + autodata[0].msg + '</td><td>' + autodata[0].created_at + '</td></tr>');
                });
            }
        });
        // var d = new Date();
        // console.log(d.toLocaleString());
    }, 500);
});
