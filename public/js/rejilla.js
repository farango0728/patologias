function showGrid(abre, cierra) {
    $("#" + abre).show();
    $("#" + cierra).hide();
    $("#tab-" + cierra).removeClass('active-tab-home');
    $("#tab-" + abre).addClass('active-tab-home');
}

const app = new Vue({
    el: '#app',
    data: {
        mostrando: 0,
        detalle_perfil: 0,
        listado_perfiles: [],
        busqueda: '',
        busqu_categoria: '',
        busqu_categoria2: '',
        listado_categorias: [],
        datos_linkedIn: [],
        datos_distinct: [],
        datos_founds: [],
        datos_members: [],
        datos_positions: [],
        imgs_drbb: [],
        cargando: 0,
        si_orcid: 0,
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0,
        },
    },
    methods: {
        buscarDetalles(arroba_id) {
            let me = this;
            console.log('buscando perfil = ' + arroba_id);
            me.cargando = 1;
            me.si_orcid = 0;
            me.datos_linkedIn = [];
            me.datos_distinct = [];
            me.datos_founds = [];
            me.datos_members = [];
            me.datos_positions = [];

            axios.get('/getDataByUser/' + arroba_id)
                .then(function(response) {
                    me.datos_linkedIn = response.data.linkedIn;
                    me.datos_distinct = response.data.datos_distinct;
                    me.datos_founds = response.data.datos_founds;
                    me.datos_members = response.data.datos_members;
                    me.datos_positions = response.data.datos_positions;
                    if (me.datos_linkedIn.token_dbb) {
                        me.buscarImagenes(me.datos_linkedIn.token_dbb);
                    } else {
                        $("#contendor-imagenes-drbb-home").html('');
                    }
                    if (me.datos_distinct.length > 0 || me.datos_founds.length > 0 || me.datos_members.length > 0 || me.datos_positions.length > 0) {
                        me.si_orcid = 1;
                    }
                    console.log(response.data);
                    me.detalle_perfil = 1;
                    me.cargando = 0;
                })
                .catch(function(error) {
                    me.cargando = 0;
                    console.log(error);
                });
        },
        buscarImagenes(usu_drbb) {
            let me = this;
            axios.get('/getDrbById/' + usu_drbb)
                .then(function(response) {

                    var imgs_drib_aux = response.data;
                    //console.log(imgs_drib_aux[0].descripcion);

                    /*var imgs_drib = $(response.data).find('.shot-thumbnail');
                     */

                    for (i = 0; i < imgs_drib_aux.length; i++) {
                        console.log(imgs_drib_aux[i].descripcion);

                        /*   var aux_i = $(this).find('picture>img');
                            var aux_a = $(this).find('a');
                            var ruta_img = $(aux_i).attr('src');
                            var ruta_a = "https://dribbble.com" + $(aux_a).attr('href');
                            var descrip = $(aux_i).attr('alt');*/


                        $("#contendor-imagenes-drbb-home").append('<div class="card rd-s-50 rd-l-25 rd-element" ><div class="card-body" style="padding-top:2rem;"><div class="rd-container-row"><div class="rd-m-100"><div class=""><a href="' + imgs_drib_aux[i].ruta_a + '" target="_blank"><img src="' + imgs_drib_aux[i].ruta_img + '"><div class="card-body"><p class="card-text">' + imgs_drib_aux[i].descripcion + '</p></div></a></div></div></div></div>');

                    }

                    /*var imgs_drib = $(response.data).find('.shot-thumbnail');
                    $("#contendor-imagenes-drbb-home").html('');
                    imgs_drib.each(function() {

                        var aux_i = $(this).find('picture>img');
                        var aux_a = $(this).find('a');
                        var ruta_img = $(aux_i).attr('src');
                        var descrip = $(aux_i).attr('alt');
                        var ruta_a = "https://dribbble.com/" + $(aux_a).attr('href');

                        $("#contendor-imagenes-drbb-home").append('<div class="card rd-s-50 rd-l-25 rd-element" ><div class="card-body" style="padding-top:2rem;"><div class="rd-container-row"><div class="rd-m-100"><div class=""><a href="' + ruta_a + '" target="_blank"><img src="' + ruta_img + '"><div class="card-body"><p class="card-text">' + descrip + '</p></div></a></div></div></div></div>');
                        //me.imgs_drbb[] = ["aux_i"]
                    });*/
                    $("#cont_btn_drbbb").html('<a target="_blank"  href="https://dribbble.com/' + usu_drbb + '" class="btn btn-info-redes"  style="margin: auto;">Ver perfil completo en Dribbble</a>');
                    //console.log('llegaaa');

                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },
        buscarPerfiles() {
            //console.log('buscando');
            this.detalle_perfil = 0;
            this.mostrando = 0;
            let me = this;
            me.cargando = 1;
            let aux_busqueda;
            let aux_busqu_categoria;

            if (this.busqueda == '') { aux_busqueda = "-1"; } else { aux_busqueda = this.busqueda; }

            if (this.busqu_categoria == '') { aux_busqu_categoria = "-1"; } else { aux_busqu_categoria = this.busqu_categoria; }

            axios.get('/getPorfolioList/' + aux_busqu_categoria + '/' + aux_busqueda)
                .then(function(response) {
                    me.listado_perfiles = response.data;
                    console.log(response);
                    me.mostrando = 1;
                    me.cargando = 0;
                })
                .catch(function(error) {
                    me.cargando = 0;
                    console.log(error);
                });

        },
        getCategorias() {
            let me = this;
            axios.get('/getCategorias')
                .then(function(response) {
                    me.busqu_categoria2 = response.data;
                    me.listado_categorias = response.data;
                    //this.listado_categorias.
                    console.log(me.busqu_categoria2);
                });
        },


    },
    mounted() {
        this.getCategorias();
        console.log('vue montado');

    }
});