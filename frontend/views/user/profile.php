<?php $this->load->view('songbook/top'); ?>
<?php $userdata = $this->session->userdata('user_data'); ?>
<?php $theme = $this->session->userdata('theme'); ?>
    
        Profile
        <div class="transbox-b-dark col-sm-8 col-sm-offset-2 col-xs-12">
            <h1>
                <span id="name"><?php echo $user->first.' '.$user->last ?></span><a id="name_edit" class="glyph glyph-edit" onclick="edit('name')"><span id="name_icon" class="glyphicon glyphicon-edit"></span></a>
            </h1>
        </div>
        <div class="padd-20 col-xs-12">
            <div class="col-md-12">
            <div class="col-md-4">
                <h3><span id="theme_id_display">Theme:</span> 
                    <span id="theme_id_view">
                        <span style="font-size:18px" id="theme_id_selected"><?php echo $theme->name; ?></span><a id="theme_id_icon_div" class="glyph glyph-edit" onclick="editHidden('theme_id')"><span id="theme_id_icon" class="glyphicon glyphicon-edit"></span></a>
                    </span>
                    <div id='theme_id_edit' style="display:none">
                        <select class="form-control" id="theme_id_input" name="status">
                            <?php foreach($themes as $t){ ?>
                                <option id='theme_id_option_<?php echo $t->ID; ?>' value="<?php echo $t->ID; ?>" <?php if($t->ID == $theme->ID){echo 'selected';} ?>><?php echo $t->name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </h3>
            </div>
            
            <div class="col-md-10 col-md-offset-1 padd-40-20">
                <div class="col-md-6 center">
                    <a onclick='updateUser()'><input id="about-btn" class="button button-info" value="Apply"></a>
                </div>
                <div class="col-md-6 center">
                    <a href="<?php echo base_url('songbook') ?>"> <input id="form-btn" class="button button-info" value="Back"></a>
                </div>
            </div>  
        </div>
    </div>
<script type="text/javascript">
    
    function updateUser(){
        changeHidden('theme_id');
        window.location.replace("<?php echo base_url('profile'); ?>");
    }
    
    function editHidden(item){
        var view = document.getElementById(item + '_view');
        var item_dis = document.getElementById(item + '_display');
        var edit = document.getElementById(item + '_edit');
        var icon = document.getElementById(item + '_icon');
        var icon_div = document.getElementById(item + '_icon_div');
        view.style.display = 'none';
        edit.style.display = '';
        icon.classList = 'glyphicon glyphicon-ok';
        icon_div.onclick = function(){ changeHidden(item); } ;
        item_dis.appendChild(icon_div);
    }
    
    function changeHidden(item){
        var view = document.getElementById(item + '_view');
        var edit = document.getElementById(item + '_edit');
        var icon = document.getElementById(item + '_icon');
        var selected = document.getElementById(item + '_selected');
        var input = document.getElementById(item + '_input');
        var icon_div = document.getElementById(item + '_icon_div');
        edit.style.display = 'none';
        view.style.display = '';
        icon.classList = 'glyphicon glyphicon-edit';
        icon_div.onclick = function(){ editHidden(item); } ;
        var value = input.value;
        var content_id = item + '_option_' + value;
        var content_div = document.getElementById(content_id);
        var content = content_div.innerHTML;
        var ajax_url = '<?php echo site_url('user/update_user_field'); ?>/' + item + '/' + value + '/' + <?php echo $user->ID; ?>;
        console.log(ajax_url);
        view.appendChild(icon_div);
        jQuery.ajax({
        url: ajax_url,
        method: 'GET',
        success: function(res){
        if( res.result ){
            selected.innerHTML = content;
        }
        }
        });
    }
</script>
<?php $this->load->view('footer'); ?>