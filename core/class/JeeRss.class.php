<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
require_once dirname(__FILE__) . '/../../core/php/JeeRss.inc.php';
require_once dirname(__FILE__) . '/../../core/config/JeeRss.config.php';
include_file('core', 'JeeRss', 'config', 'JeeRss');

class JeeRss extends eqLogic {
    /*     * *************************Attributs****************************** */

	
    /*     * ***********************Methode static*************************** */

    public static function cron() {
		
		foreach (eqLogic::byType('JeeRss') as $JeeRss) {
			if ($JeeRss->getConfiguration('frequence') == '1m') {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				sleep(1);
				$JeeRss->toHtml();
				sleep(1);
				$JeeRss->affiche_rss();
				log::add('JeeRss', 'debug', 'Actualisation du Flux RSS ' . $JeeRss->getName() . ' toutes les minutes effectuée');
			}
		}
		
	}
	
    public static function cron5() {

		foreach (eqLogic::byType('JeeRss') as $JeeRss) {
			if ($JeeRss->getConfiguration('frequence') == '5m') {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				sleep(1);
				$JeeRss->toHtml();
				sleep(1);
				$JeeRss->affiche_rss();
				log::add('JeeRss', 'debug', 'Actualisation du Flux RSS ' . $JeeRss->getName() . ' toutes les 5 minutes effectuée');
			}
		}

	}

    public static function cron15() {
		
		foreach (eqLogic::byType('JeeRss') as $JeeRss) {
			if ($JeeRss->getConfiguration('frequence') == '15m') {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				sleep(1);
				$JeeRss->toHtml();
				sleep(1);
				$JeeRss->affiche_rss();
				log::add('JeeRss', 'debug', 'Actualisation du Flux RSS ' . $JeeRss->getName() . ' toutes les 15 minutes effectuée');
			}
		}
		
	}
	
    public static function cron30() {
		
		foreach (eqLogic::byType('JeeRss') as $JeeRss) {
			if ($JeeRss->getConfiguration('frequence') == '30m') {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				sleep(1);
				$JeeRss->toHtml();
				sleep(1);
				$JeeRss->affiche_rss();
				log::add('JeeRss', 'debug', 'Actualisation du Flux RSS ' . $JeeRss->getName() . ' toutes les 30 minutes effectuée');
			}
		}

	}
	
    public static function cronHourly() {
		
		foreach (eqLogic::byType('JeeRss') as $JeeRss) {
			if ($JeeRss->getConfiguration('frequence') == '1h' OR $JeeRss->getConfiguration('frequence') == '') {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				sleep(1);
				$JeeRss->toHtml();
				sleep(1);
				$JeeRss->affiche_rss();
				log::add('JeeRss', 'debug', 'Actualisation du Flux RSS ' . $JeeRss->getName() . ' 1 fois par heure effectuée');
			}
		}

	}
	
    public static function cronDaily() {
		
		foreach (eqLogic::byType('JeeRss') as $JeeRss) {
			if ($JeeRss->getConfiguration('frequence') == '1j') {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				sleep(1);
				$JeeRss->toHtml();
				sleep(1);
				$JeeRss->affiche_rss();
				log::add('JeeRss', 'debug', 'Actualisation du Flux RSS ' . $JeeRss->getName() . ' 1 fois par jour effectuée');
			}
		}

	}
	
	public static function dependancy_info() {

	}
	public static function dependancy_install() {

	}
	
	public static function deamon_info() {

	}

	public static function deamon_start() {

	}

	public static function deamon_stop() {

	}
	
    /*
     * Fonction exécutée automatiquement toutes les minutes par Jeedom
      public static function cron() {

      }
     */


    /*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {

      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDayly() {

      }
     */



    /*     * *********************Méthodes d'instance************************* */
	
    public function preInsert() {
	    	if (JeeRss::getConfiguration('fg_color') == null) {
			JeeRss::setConfiguration('fg_color', "#ffffff");
		}
		if (JeeRss::getConfiguration('vitesse') == null) {
			JeeRss::setConfiguration('vitesse', 4);
		}
		if (JeeRss::getConfiguration('nb_flux') == null) {
			JeeRss::setConfiguration('nb_flux', 5);
		}
		if (JeeRss::getConfiguration('frequence') == null) {
			JeeRss::setConfiguration('frequence', "30m");
		}
		if (JeeRss::getConfiguration('sens') == null) {
			JeeRss::setConfiguration('sens', "left");
		}
		if (JeeRss::getConfiguration('espacement_flux') == null) {
			JeeRss::setConfiguration('espacement_flux', 1);
		}
    }

    public function postInsert() {

    }

    public function preSave() {
	    	if (JeeRss::getConfiguration('fg_color') == null) {
			JeeRss::setConfiguration('fg_color', "#ffffff");
		}
		if (JeeRss::getConfiguration('vitesse') == null) {
			JeeRss::setConfiguration('vitesse', 4);
		}
		if (JeeRss::getConfiguration('nb_flux') == null) {
			JeeRss::setConfiguration('nb_flux', 5);
		}
		if (JeeRss::getConfiguration('frequence') == null) {
			JeeRss::setConfiguration('frequence', "30m");
		}
		if (JeeRss::getConfiguration('sens') == null) {
			JeeRss::setConfiguration('sens', "left");
		}
		if (JeeRss::getConfiguration('espacement_flux') == null) {
			JeeRss::setConfiguration('espacement_flux', 1);
		}
	}

    public function postSave() {
		if (!$this->getId())
          return;
    }

    public function preUpdate() {
		$this->remove_cache_rss();
    }

    public function postUpdate() {
		$this->cache_rss();
		sleep(1);
		$this->refreshWidget();
		$this->autoAjoutCommande();
		$this->affiche_rss();
    }

    public function preRemove() {
		$this->remove_cache_rss();
    }

    public function postRemove() {
		
    }

 	public function toHtml($_version = 'dashboard')	{
		$replace = $this->preToHtml($_version);
		if (!is_array($replace)) {
			return $replace;
		}
		
		$_version = jeedom::versionAlias($_version);
		
		
		$cache_Rss = realpath(dirname(__FILE__) . '/../../core/config') . '/' . JeeRss::getId();
		if(file_exists($cache_Rss)) {
			log::add('JeeRss', 'debug', 'DEBUG - Le fichier cache existe -> ' . $cache_Rss);
			$rss = JeeRss::affiche_rss();
			
			foreach ($this->getCmd('action') as $cmd) {
				$replace['#cmd_refresh_id#'] = $cmd->getId();
			}
			
			$replace['#fg_color#'] = JeeRss::getConfiguration('fg_color');
			$replace['#vitesse#'] = JeeRss::getConfiguration('vitesse');
			$replace['#direction#'] = JeeRss::getConfiguration('sens');

			$auto = JeeRss::getConfiguration('auto');
			if ($auto == 0) {
				$taille = JeeRss::getConfiguration('taille');
				$replace['#width#'] = JeeRss::getConfiguration('taille').'%';
			}
			
			$date = JeeRss::getConfiguration('date');
			$heure = JeeRss::getConfiguration('heure');
			
			if(JeeRss::getConfiguration('espacement_flux') < 1) {
				$espacement_flux = 1;
			}
			else {
				$espacement_flux = JeeRss::getConfiguration('espacement_flux');
			}
			
			
			if (JeeRss::getConfiguration('sens') == "right" or JeeRss::getConfiguration('sens') == "left") {
				for ($i = 1; $i <= (15*$espacement_flux); $i++) {
					$espacement .= '&nbsp;';
				}
				$espacement = $espacement.'|'.$espacement;
			}
			elseif (JeeRss::getConfiguration('sens') == "up" or JeeRss::getConfiguration('sens') == "down") {
				for ($i = 1; $i <= $espacement_flux; $i++) {
					$espacement .= '</br>';
				}
			}
			
			foreach (array_slice($rss, 0, JeeRss::getConfiguration('nb_flux')) as $tab) {
				if ($date == 1) {
					$ligne .= ' le ' . date("d/m/Y",strtotime($tab[3]));
				}
				if ($heure == 1) {
					$ligne .= ' à ' . date("H:m",strtotime($tab[3])); 
				}
				
				$ligne .= ' - ' . '<a style="color:' . JeeRss::getConfiguration('fg_color') . ';" target="_blank" href="'.$tab[1].'"><span style="color:' . JeeRss::getConfiguration('fg_color') . ';"><b>'.$tab[0].'</b></span></a>' . $espacement;
			}

			$replace['#flux#'] = $ligne;
		}
		else {
			log::add('JeeRss', 'debug', 'DEBUG - Le fichier cache introuvable -> ' . $cache_Rss);
			$replace['#flux#'] = 'Le fichier cache introuvable -> ' . $cache_Rss;
		}	
		// les variables
	
		$html = template_replace($replace, getTemplate('core', $_version, 'current','JeeRss'));
		
		return $html;
	}
	
    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */
	
	public function lecture_rss($fichier, $objets) {
		// on lit tout le fichier
		if($chaine = @implode("",@file($fichier))) {
	 
			// on découpe la chaine obtenue en items
			$tmp = preg_split("/<\/?"."item".">/",$chaine);
	 
			// pour chaque item
			for($i=1;$i<sizeof($tmp)-1;$i+=2)
	 
				// on lit chaque objet de l'item
				foreach($objets as $objet) {
	 
					// on découpe la chaine pour obtenir le contenu de l'objet
					$tmp2 = preg_split("/<\/?".$objet.">/",$tmp[$i]);
	 
					// on ajoute le contenu de l'objet au tableau resultat
					$resultat[$i-1][] = @$tmp2[1];
				}
	 
			// on retourne le tableau resultat
			return $resultat;
		}
	}
	
	public function affiche_rss() {
		// Balise				Description
		// title				Titre de l'item
		// link					URL de l'item
		// description			Description de l'item
		// author				Mail de l'auteur de l'item
		// category				Catégorie à laquelle l'item appartient
		// comments				Lien vers une page de commentaires sur l'item
		// enclosure			Objet media attaché à l'item
		// guid					Texte qui identifie de manière unique cet item
		// pubDate				Date de publication
		// source				Channel auquel l'item appartient		
		
		$fichier = realpath(dirname(__FILE__) . '/../../core/config') . '/' . JeeRss::getId();
		
		$rss = JeeRss::lecture_rss("$fichier",array("title","link","description","pubDate"));
		
		$i = 0;
		foreach (eqLogic::getCmd() as $info) {
			
			while (html_entity_decode($rss[$i][0]) == "" and $i <= 30) {
				$i++;
			}
			
			if (html_entity_decode($rss[$i][0]) != "") {
				$info->setConfiguration('titre', html_entity_decode($rss[$i][0]));
				$info->save();
				$info->event(html_entity_decode($rss[$i][0]));
				$i++;
			}
			else {
				$info->setConfiguration('titre', '');
				$info->save();
				$info->event();
				$i++;
			}
		}
			
		return $rss;
	}

	public function cache_rss() {
		log::add('JeeRss', 'debug', 'Mise en Cache Flux RSS : ' . JeeRss::getName());
		if (!JeeRss::getConfiguration('adresse')) {
			$adresse = 'https://www.jeedom.com/blog/?feed=rss2';
		}
		else {
			$adresse = JeeRss::getConfiguration('adresse');
		}
		
		$cmd = 'wget ' . $adresse . ' -O ' . realpath(dirname(__FILE__) . '/../../core/config') . '/' . JeeRss::getId() . ' 2>&1';
		$cmd_droit =  'sudo chmod 777 ' . realpath(dirname(__FILE__) . '/../../core/config') . '/' . JeeRss::getId() . ' 2>&1';
		exec($cmd);
		exec($cmd_droit);
	}
	
	public function remove_cache_rss() {
		$fichier = realpath(dirname(__FILE__) . '/../../core/config') . '/' . JeeRss::getId();
		@unlink($fichier);
		log::add('JeeRss', 'debug', 'Suppression Cache Flux RSS : ' . JeeRss::getName() . ' -> ' . $fichier);
	}

    public function autoAjoutCommande() {
		
		global $listCmdJeeRss;
		$list_cmd = $listCmdJeeRss;
		
        foreach ($list_cmd as $cmd) {
			   if (cmd::byEqLogicIdCmdName($this->getId(), $cmd['name']))
					return;
				
			   if ($cmd) {
					$JeeRssCmd = new JeeRssCmd();
					$JeeRssCmd->setName(__($cmd['name'], __FILE__));
					$JeeRssCmd->setEqLogic_id($this->id);
					$JeeRssCmd->setType($cmd['type']);
					$JeeRssCmd->setSubType($cmd['subType']);
					$JeeRssCmd->setOrder($cmd['order']);
					$JeeRssCmd->setConfiguration('titre', $cmd['configuration']['titre']);
					$JeeRssCmd->save();
			   }

        }
    }	
    /*     * **********************Getteur Setteur*************************** */
	
}

class JeeRssCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */
	
	public function execute($_options = array()) {

		$eqLogic = $this->getEqLogic();

		if ($this->getName() == "Refresh") {
			$eqLogic->cache_rss();
			sleep(1);
			$eqLogic->refreshWidget();
			sleep(1);
			$eqLogic->toHtml();
			sleep(1);
			$eqLogic->affiche_rss();		
		}
		return;
	}

    /*     * **********************Getteur Setteur*************************** */
}

?>
