if(typeof(ss) == 'undefined' || typeof(ss.i18n) == 'undefined') {
	console.error('Class ss.i18n not defined');
} else {
	ss.i18n.addDictionary('fr_FR', {
		'CMSMAIN.WARNINGSAVEPAGESBEFOREADDING' : "Vous devez sauvegarder la page avant d\'y ajouter des enfants",
		'CMSMAIN.CANTADDCHILDREN' : "Vous ne pouvez pas ajouter des enfants au noeud sélectionné",
		'CMSMAIN.ERRORADDINGPAGE' : 'Erreur lors de l\'ajout de la page',
		'CMSMAIN.FILTEREDTREE' : 'Filtrer l\'arbre pour n\'afficher que les pages modifiées',
		'CMSMAIN.ERRORFILTERPAGES' : 'Impossible de filtrer l\'arbre pour n\'afficher que les pages modifiées<br />%s',
		'CMSMAIN.ERRORUNFILTER' : 'Impossible d\'afficher l\'ensemble de l\'arbre du site<br />%s',
		'CMSMAIN.ERRORUNFILTER' : 'Arbre non-filtré',
		'CMSMAIN.PUBLISHINGPAGES' : 'Publication des pages...',
		'CMSMAIN.SELECTONEPAGE' : "Veuillez sélectionner au moins une page.",
		'CMSMAIN.ERRORPUBLISHING' : 'Erreur lors de la publication des pages',
		'CMSMAIN.REALLYDELETEPAGES' : "Etes-vous sûr de vouloir supprimer les %s pages marquées ?",
		'CMSMAIN.DELETINGPAGES' : 'Suppression des pages...',
		'CMSMAIN.ERRORDELETINGPAGES': 'Erreur lors de la suppression des pages',
		'CMSMAIN.PUBLISHING' : 'Publication...',
		'CMSMAIN.RESTORING': 'Restauration...',
		'CMSMAIN.ERRORREVERTING': 'Erreur lors de la restauration vers le contenu Live',
		'CMSMAIN.SAVING' : 'sauvegarde...',
		'CMSMAIN.SELECTMOREPAGES' : "Vous avez %s pages sélectionnées.\n\nVoulez-vous vraiment effectuer cette action?", 
		'ModelAdmin.SAVED': "Sauvegardé",
		'ModelAdmin.REALLYDELETE': "Etes-vous sûr de vouloir supprimer ?",
		'ModelAdmin.DELETED': "Supprimé",
		'LeftAndMain.PAGEWASDELETED': "Cette page a été supprimée. Pour éditer cette page, veuillez la sélectionner à gauche.",
		'LeftAndMain.CONFIRMUNSAVED': "Etes-vous sûr de vouloir quitter cette page ?\n\nATTENTION: Vos changements n'ont pas été sauvegardés.\n\nCliquez sur OK pour continuer, ou sur Annuler pour rester sur la page actuelle."
	});
}