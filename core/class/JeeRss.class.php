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
		if (config::byKey('frequence', 'JeeRss') == '1m') {
			foreach (eqLogic::byType('JeeRss') as $JeeRss) {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				log::add('JeeRss', 'debug', 'Actualisation Flux RSS toutes les minutes');
			}
		}
	}
	
    public static function cron5() {
		if (config::byKey('frequence', 'JeeRss') == '5m') {
			foreach (eqLogic::byType('JeeRss') as $JeeRss) {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				log::add('JeeRss', 'debug', 'Actualisation Flux RSS toutes les 5 minutes');
			}
		}
	}

    public static function cron15() {
		if (config::byKey('frequence', 'JeeRss') == '15m') {
			foreach (eqLogic::byType('JeeRss') as $JeeRss) {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				log::add('JeeRss', 'debug', 'Actualisation Flux RSS toutes les 15 minutes');
			}
		}
	}
	
    public static function cron30() {
		if (config::byKey('frequence', 'JeeRss') == '30m') {
			foreach (eqLogic::byType('JeeRss') as $JeeRss) {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				log::add('JeeRss', 'debug', 'Actualisation Flux RSS toutes les 30 minutes');
			}
		}
	}
	
    public static function cronHourly() {
		if (config::byKey('frequence', 'JeeRss') == '1h') {
			foreach (eqLogic::byType('JeeRss') as $JeeRss) {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				log::add('JeeRss', 'debug', 'Actualisation Flux RSS 1 fois par heure');
			}
		}
	}
	
    public static function cronDaily() {
		if (config::byKey('frequence', 'JeeRss') == '1j') {
			foreach (eqLogic::byType('JeeRss') as $JeeRss) {
				$JeeRss->cache_rss();
				sleep(1);
				$JeeRss->refreshWidget();
				log::add('JeeRss', 'debug', 'Actualisation Flux RSS 1 fois par jour');
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

    }

    public function postInsert() {

    }

    public function preSave() {

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
		
		
		$cache_Rss = dirname(__FILE__) . '/../../core/config/' . JeeRss::getId();
		if(file_exists($cache_Rss)) {
			log::add('JeeRss', 'debug', 'DEBUG - Le fichier cache existe -> ' . $cache_Rss);
			$rss = JeeRss::affiche_rss();
			
			foreach ($this->getCmd('action') as $cmd) {
				$replace['#cmd_refresh_id#'] = $cmd->getId();
			}
			
			$replace['#vitesse#'] = JeeRss::getConfiguration('vitesse');
			$replace['#direction#'] = JeeRss::getConfiguration('sens');

			$auto = JeeRss::getConfiguration('auto');
			if ($auto == 0) {
				$taille = JeeRss::getConfiguration('taille');
				$replace['#width#'] = JeeRss::getConfiguration('taille').'%';
			}
			
			$date = JeeRss::getConfiguration('date');
			$heure = JeeRss::getConfiguration('heure');
			
			for ($i = 1; $i <= 15; $i++) {
				$espacement .= '&nbsp;';
			}
			$espacement = $espacement.'|'.$espacement;
			
			foreach ($rss as $tab) {
				if ($date == 1) {
					$ligne .= ' le ' . date("d/m/Y",strtotime($tab[3]));
				}
				if ($heure == 1) {
					$ligne .= ' à ' . date("H:m",strtotime($tab[3])); 
				}
				
				$ligne .= ' - ' . '<a target="_blank" href="'.$tab[1].'">'.$tab[0].'</a>' . $espacement;
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
		
		$fichier = dirname(__FILE__) . '/../../core/config/' . JeeRss::getId();
		
		$rss = JeeRss::lecture_rss("$fichier",array("title","link","description","pubDate"));

		foreach (eqLogic::getCmd() as $info) {
			$info->setConfiguration('titre', $rss[0][0]);
			$info->save();
			$info->event($rss[0][0]);
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
		
		$cmd = 'wget ' . $adresse . ' -O ' . dirname(__FILE__) . '/../../core/config/' . JeeRss::getId() . ' 2>&1';
		$cmd_droit =  'sudo chmod 777 ' . dirname(__FILE__) . '/../../core/config/' . JeeRss::getId() . ' 2>&1';
		exec($cmd);
		exec($cmd_droit);
	}

	public function remove_cache_rss() {
		$fichier = dirname(__FILE__) . '/../../core/config/' . JeeRss::getId();
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
		}
		return;
	}

    /*     * **********************Getteur Setteur*************************** */
}

?>
