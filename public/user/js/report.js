/*
 *   Bagian ini digunakan untuk halaman head report form
 */
window.onload = function () {
    /*
     *   METHOD MEMUNCULKAN INPUT FIELD BARU
     */
    for (let index = 2; index <= 10; index++) {
        $("#dynamicFields" + index).addClass("hidden");
    }
    var $i = 1;
    $("#add").on("click", function () {
        if ($i < 10) {
            $i++;
            $("#dynamicFields" + $i).removeClass("hidden");
        }
    });
    /*
     *   METHOD MENYEMBUNYIKAN INPUT FIELD  YANG BARU DITAMBAHKAN
     */
    $("#remove").on("click", function () {
        if (!($i <= 1)) {
            $("#dynamicFields" + $i).addClass("hidden");
            $("#expertForms" + $i)
                .val(null)
                .trigger("change");
            $("#expertCompanyForms" + $i)
                .val(null)
                .trigger("change");
            $("#expertNipForms" + $i)
                .val(null)
                .trigger("change");
            $i--;
        }
    });

    /*
     *
     */
    function checkId(num) {
        var id = parseInt($("#expertForms" + num).val());
        // console.log($("#expertForms1").val());
        if (!isNaN(id) || $("#expertForms" + num).val() == "") {
            $("#expertCompanyForms" + num).prop("disabled", true);
            $("#expertNipForms" + num).prop("disabled", true);
        }
    }
    $("#dynamicFields1").on("change", function () {
        checkId(1);
    });
    $("#dynamicFields2").on("change", function () {
        checkId(2);
    });
    $("#dynamicFields3").on("change", function () {
        checkId(3);
    });
    $("#dynamicFields4").on("change", function () {
        checkId(4);
    });
    $("#dynamicFields5").on("change", function () {
        checkId(5);
    });
    $("#dynamicFields6").on("change", function () {
        checkId(6);
    });
    $("#dynamicFields7").on("change", function () {
        checkId(7);
    });
    $("#dynamicFields8").on("change", function () {
        checkId(8);
    });
    $("#dynamicFields9").on("change", function () {
        checkId(9);
    });
    $("#dynamicFields10").on("change", function () {
        checkId(10);
    });

    /*
     *   METHOD MENONAKTIFKAN FIELD
     *   Menonaktifkan field sebelum user mengisikan form sebelumnya
     */
    disbaleAddRemove();
    $("#expertForms1").on("change", function () {
        if ($("#expertForms1").val() == "") {
            disbaleAddRemove();
        } else {
            enableAddRemove();
        }
    });
    function disbaleAddRemove() {
        $("#add").prop("disabled", true);
        $("#remove").prop("disabled", true);
    }
    function enableAddRemove() {
        $("#add").prop("disabled", false);
        $("#remove").prop("disabled", false);
    }

    /*
     *   FUNGSI MEMANGGIL CKEDITOR
     */
    // ClassicEditor.create(document.querySelector("#editor"))
    // .catch((error) => {
    //     console.error(error);
    // });
    let editor;

    ClassicEditor.create(document.querySelector("#editor"))
        .then((newEditor) => {
            editor = newEditor;
        })
        .catch((error) => {
            console.error(error);
        });

    // Assuming there is a <button id="submit">Submit</button> in your application.
    // $("#save").on("click", () => {
    //     const editorData = editor.getData();

    //     console.log(editorData);
    // });
};
