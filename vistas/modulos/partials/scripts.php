<script>
    const dataTableCategory = new DataTable('#tableCategories', {
        searchable: true,
        perPageSelect: false,
        perPage: 2
    });

    const dataTableSocialNetworks = new DataTable('#tableSocialNetwork', {
        searchable: true,
        perPageSelect: false,
        perPage: 2
    });
    
    const dataTableFormats = new DataTable('#tableFormat', {
        searchable: true,
        perPageSelect: false,
        perPage: 5
    });

    const dataTableSections = new DataTable('#tableSection', {
        searchable: true,
        perPageSelect: false,
        perPage: 5
    });

    const formFormat = () => {
        document.getElementById("formFormat").style.display == "flex" ?
        document.getElementById("formFormat").style.display = "none" :
        document.getElementById("formFormat").style.display = "flex";
    };

    const formFormatEdit = (id) => {
        document.getElementById("format_id").value = id;
        document.getElementById("formFormatEdit").style.display == "flex" ?
        document.getElementById("formFormatEdit").style.display = "none" :
        document.getElementById("formFormatEdit").style.display = "flex";
    };
</script>
<script src="./vistas/js/jquery.min.js"></script>
<script src="./vistas/js/popper.min.js"></script>
<script src="./vistas/js/bootstrap.min.js"></script>
<script src="./vistas/js/roberto.bundle.js"></script>
<script src="./vistas/js/default-assets/active.js"></script>