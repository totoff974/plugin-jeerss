<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
global $listCmdJeeRss;
include_file('core', 'JeeRss', 'config', 'JeeRss');
sendVarToJS('eqType', 'JeeRss');
$eqLogics = eqLogic::byType('JeeRss');

?>

<div class="row row-overflow">
    <div class="col-lg-2 col-md-3 col-sm-4">
        <div class="bs-sidebar">
            <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
                <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un Flux RSS}}</a>
                <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
                <?php
foreach ($eqLogics as $eqLogic) {
	echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
}
?>
           </ul>
       </div>
   </div>

   <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
    <legend>{{Gestion}}
    </legend>

    <div class="eqLogicThumbnailContainer">
      <div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
         <center>
            <i class="fa fa-plus-circle" style="font-size : 7em;color:#94ca02;"></i>
        </center>
        <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#94ca02"><center>{{Ajouter}}</center></span>
	</div>
	</div>
<legend><i class="icon meteo-soleil"></i>  {{Mes Flux Rss}}
</legend>
<div class="eqLogicThumbnailContainer">
    <?php
foreach ($eqLogics as $eqLogic) {
	echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >';
	echo "<center>";
	echo '<img src="plugins/JeeRss/doc/images/JeeRss_icon.png" height="105" width="95" />';
	echo "</center>";
	echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
	echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
   <a class="btn btn-success eqLogicAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
   <a class="btn btn-danger eqLogicAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>

   <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#eqlogictab" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-tachometer"></i> {{Configuration du Flux RSS}}</a></li>
	<li role="presentation"><a href="#commandtab" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i> {{Commandes}}</a></li>
</ul>

<div class="tab-content" style="height:calc(100% - 50px);overflow:auto;overflow-x: hidden;">
    <div role="tabpanel" class="tab-pane active" id="eqlogictab">
		<form class="form-horizontal">
			<fieldset>
				<legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}<i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
				<div class="form-group">
					<label class="col-lg-2 control-label">{{Nom du Flux RSS}}</label>
					<div class="col-lg-3">
						<input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
						<input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom du module}}"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" >{{Objet parent}}</label>
					<div class="col-lg-3">
						<select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
							<option value="">{{Aucun}}</option>
							<?php
								foreach (jeeObject::all() as $object) {
									echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label">{{Catégorie}}</label>
					<div class="col-lg-8">
						<?php
							foreach (jeedom::getConfiguration('eqLogic:category') as $key => $value) {
								echo '<label class="checkbox-inline">';
								echo '<input type="checkbox" class="eqLogicAttr" data-l1key="category" data-l2key="' . $key . '" />' . $value['name'];
								echo '</label>';
							}
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" ></label>
					<div class="col-sm-9">
						<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isEnable" checked/>{{Activer}}</label>
						<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="isVisible" checked/>{{Visible}}</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">{{Adresse du flux RSS}}</label>
					<div class="col-sm-3">
						<input type="text" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="adresse" placeholder="{{https://www.jeedom.com/blog/?feed=rss2}}"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Couleur du texte</label>
					<div class="col-sm-3">
						<input type="color" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="fg_color" value="#ffffff"/>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-lg-3 control-label">{{Nombre de flux à afficher}}</label>
					<div class="col-sm-3">
						<select class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="nb_flux">
							<option value=1>{{1}}</option>
							<option value=5>{{5}}</option>
							<option value=10>{{10}}</option>
							<option value=-1>{{tous}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">{{Fréquence de l'actualisation}}</label>
					<div class="col-sm-3">
						<select class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="frequence">
							<option value="1m">{{toutes les minutes}}</option>
							<option value="5m">{{toutes les 5 minutes}}</option>
							<option value="15m">{{toutes les 15 minutes}}</option>
							<option value="30m">{{toutes les 30 minutes}}</option>
							<option value="1h">{{1 fois par heure}}</option>
							<option value="1j">{{1 fois par jour}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">{{Vitesse du déplacement}}</label>
					<div class="col-sm-3">
						<input type="number" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="vitesse"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">{{Sens du déplacement}}</label>
					<div class="col-sm-3">
						<select class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="sens">
							<option value="left">{{Vers la Gauche}}</option>
							<option value="right">{{Vers la Droite}}</option>
							<option value="up">{{Vers le Haut}}</option>
							<option value="down">{{Vers le Bas}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-3 control-label">{{Espacement des Flux}}</label>
					<div class="col-sm-3">
						<input type="number" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="espacement_flux"/>
					</div>
				</div>
				<div class="form-group">
				<label class="col-lg-3 control-label">{{Afficher la date et/ou l'heure}}</label>
					<div class="col-sm-9">
						<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="date" checked/>{{Date}}</label>
						<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="heure" checked/>{{Heure}}</label>
					</div>
				</div>
				<div class="form-group">
				<label class="col-lg-3 control-label">{{Dimensions du Widget}}</label>
					<div class="col-sm-6">
						<div class="col-sm-3">
						<label class="checkbox-inline"><input type="checkbox" class="eqLogicAttr" data-l1key="configuration" data-l2key="auto" checked/>{{Dimensions Auto}}</label>
						</div>
						<div class="col-sm-6">
						<input type="range" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="taille" max="100" min="0" step="5" />
						<output></output>
						<script>
						$(function() {
							$('.eqLogicAttr[data-l1key=configuration][data-l2key=taille]').load('input', function() {
								var $old_set = $(this).val();
								$(this).next().text($old_set+'%');
							});
							var $old_val = $('.eqLogicAttr[data-l1key=configuration][data-l2key=taille]').val();
							$(this).next().text($old_val+'%');
							$('.eqLogicAttr[data-l1key=configuration][data-l2key=taille]').on('input', function() {
								var $set = $(this).val();
								$(this).next().text($set+'%');
							});
						});
						</script>
					</div>
				</div>
			</fieldset> 
		</form>
</div>
<div role="tabpanel" class="tab-pane" id="commandtab">
	<legend>{{Commandes}}</legend>
			<table id="table_cmd" class="table table-bordered table-condensed">
				<thead>
					<tr>
					<th class="col-sm-1">#</th>
					<th class="col-sm-2">{{Nom}}</th>
					<th class="col-sm-2">{{Sous-Type}}</th>
					<th>{{Valeur}}</th>
					<th>{{Paramètres}}</th>
					<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
</div>
</div>
</div>
						
<?php include_file('desktop', 'JeeRss', 'js', 'JeeRss');?>
<?php include_file('core', 'plugin.template', 'js');?>
