package GestionDesAdherents.graphique;

import java.awt.EventQueue;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

import org.xml.sax.SAXException;

import javax.swing.ButtonGroup;
import javax.swing.DefaultComboBoxModel;
import javax.swing.DefaultListModel;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JRadioButton;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;
import javax.xml.parsers.ParserConfigurationException;

import GestionDesAdherents.Adherent;
import repository.CategorieRepository;

/**
 * Cette classe représente la fenêtre de formulaire d'inscription.
 */
public class JFFormulaireInscription extends JFrame {

    private static final long serialVersionUID = 1L;
    private JPanel contentPane;
    private JTextField txt_nom;
    private JTextField txt_prenom;
    private final ButtonGroup buttonGroup = new ButtonGroup();
    private JTextField txt_jours;
    private JTextField txt_mois;
    private JTextField txt_annee;
    private JRadioButton rdbtnM;
    private JRadioButton rdbtnF;
    private JComboBox cbx_nationalite;
    private Adherent adherentActuel;
	
    /**
	 * Launch the application.
	 */
    public static void main(String[] args) {
        EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    JFGestionDesAdherents gestionAdherents = new JFGestionDesAdherents(); // Create the instance
                    JFFormulaireInscription frame = new JFFormulaireInscription(gestionAdherents); // Pass the instance
                    frame.setVisible(true);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }
    
    public void preRemplirFormulaire(Adherent adherent) {
        this.adherentActuel = adherent;
    	
        // Remplir les champs du formulaire avec les données de l'adhérent
        txt_prenom.setText(adherent.getPrenom());
        txt_nom.setText(adherent.getNom());
        
        // Remplir le genre
        if (adherent.getGenre().equals("Masculin")) {
            rdbtnM.setSelected(true);
        } else if (adherent.getGenre().equals("Féminin")) {
            rdbtnF.setSelected(true);
        }

        // Remplir la date de naissance
        SimpleDateFormat dateFormat = new SimpleDateFormat("dd/MM/yyyy");
        String dateNaissanceStr = dateFormat.format(adherent.getDateAniv());
        String[] dateParts = dateNaissanceStr.split("/");
        txt_jours.setText(dateParts[0]);
        txt_mois.setText(dateParts[1]);
        txt_annee.setText(dateParts[2]);

        txt_paysNaiss.setText(adherent.getPaysNaiss());

        // Remplir la nationalité
        String nationalite = adherent.getNationalite();
        cbx_nationalite.setSelectedItem(nationalite);

        txt_adresse.setText(adherent.getAdresse());
        txt_cp.setText(Integer.toString(adherent.getCP()));
        txt_email.setText(adherent.getMail());
        txt_tuteur.setText(adherent.getTuteur());
        txt_numTel.setText(Integer.toString(adherent.getNumTel()));
        txt_ville.setText(adherent.getVille());
    }
    
 // Méthode pour vérifier si une chaîne ne contient que des lettres
    private boolean estFormatLettreUniquement(String texte) {
    	boolean ok = false;
    	if (!texte.isEmpty() && texte.matches("^[a-zA-Z ]*$")) {
    		ok = true;
    	}
    	return ok;
    }

 // Méthode pour vérifier si une chaîne est au format "jj/mm/aaaa"
    private boolean estFormatDateValide(String jour, String mois, String annee) {
        if (jour.isEmpty() || mois.isEmpty() || annee.isEmpty()) {
            return false; // L'un des champs est vide, ce n'est pas un format valide
        }

        if (!jour.matches("^[0-9]*$") || !mois.matches("^[0-9]*$") || !annee.matches("^[0-9]*$")) {
            return false; // Les champs ne contiennent pas que des chiffres
        }

        int jourInt = Integer.parseInt(jour);
        int moisInt = Integer.parseInt(mois);
        if (moisInt < 1 || moisInt > 12 || jourInt < 1 || jourInt > 31) {
            return false; // Mois ou jour en dehors des limites valides
        }

        // Vous pouvez ajouter des vérifications plus avancées pour les années bissextiles ici si nécessaire

        return true;
    }


    // Méthode pour vérifier si une chaîne est un code postal valide
    private boolean estFormatCodePostalValide(String codePostal) {
    	boolean ok = false;
    	if(!codePostal.isEmpty() && codePostal.matches("^[0-9]*$") && codePostal.length() == 5) {
    		ok = true;
    	}
    	return ok;
    }

    // Méthode pour vérifier si une chaîne est une adresse e-mail valide (exemple simple)
    private boolean estFormatEmailValide(String email) {
    	boolean ok = false;
    	if (!email.isEmpty() && email.matches("^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$")) {
    		ok = true;
    	}
    	return ok;
    }

    // Méthode pour vérifier si une chaîne est un numéro de téléphone valide (exemple simple)
    private boolean estFormatNumeroTelValide(String numeroTel) {
    	boolean ok = false;
    	if (!numeroTel.isEmpty() && numeroTel.matches("^[0-9]*$") && numeroTel.length() >= 10) {
    		ok = true;
    	}
    	return ok;
    }
    
 // Méthode pour vérifier si une chaîne contient uniquement des chiffres et des lettres
    private boolean estFormatAlphaNumeriqueValide(String chaine) {
        boolean ok = false;

        if (!chaine.isEmpty() && chaine.matches("^[a-zA-Z0-9 ]*$")) {
            ok = true;
        }

        return ok;
    }
    
    private void afficherMessageErreur(String message) {
        JOptionPane.showMessageDialog(this, message, "Erreur", JOptionPane.ERROR_MESSAGE);
    }

    /**
     * Constructeur de la classe JFFormulaireInscription.
     * 
     * @param gestionAdherents L'instance de la fenêtre de gestion des adhérents pour laquelle ce formulaire est ouvert.
     * @throws ParserConfigurationException En cas d'erreur de configuration du parser XML.
     * @throws SAXException                 En cas d'erreur SAX lors de l'analyse du XML.
     * @throws IOException                  En cas d'erreur d'entrée/sortie.
     * @throws ParseException               En cas d'erreur de conversion de chaîne en date.
     */
    public JFFormulaireInscription(JFGestionDesAdherents gestionAdherents) throws ParserConfigurationException, SAXException, IOException, ParseException {
        setResizable(false);
		setTitle("Formulaire d'inscription");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 960, 678);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JLabel lblNewLabel = new JLabel("Formulaire d'inscription");
		lblNewLabel.setFont(new Font("OCR A Extended", Font.BOLD, 18));
		lblNewLabel.setBounds(320, 10, 287, 36);
		contentPane.add(lblNewLabel);
		
		JLabel lblNewLabel_1 = new JLabel("Nom :");
		lblNewLabel_1.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1.setBounds(41, 58, 114, 14);
		contentPane.add(lblNewLabel_1);
		
		JLabel lblNewLabel_1_1 = new JLabel("Prénom :");
		lblNewLabel_1_1.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_1.setBounds(17, 83, 163, 14);
		contentPane.add(lblNewLabel_1_1);
		
		JLabel lblNewLabel_1_1_1 = new JLabel("Genre :");
		lblNewLabel_1_1_1.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_1_1.setBounds(25, 108, 88, 14);
		contentPane.add(lblNewLabel_1_1_1);
		
		txt_nom = new JTextField();
		txt_nom.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_nom.setBounds(145, 56, 185, 20);
		contentPane.add(txt_nom);
		txt_nom.setColumns(10);
		
		txt_prenom = new JTextField();
		txt_prenom.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_prenom.setColumns(10);
		txt_prenom.setBounds(145, 79, 185, 20);
		contentPane.add(txt_prenom);
		
        rdbtnM = new JRadioButton("Masculin");
        buttonGroup.add(rdbtnM);
        rdbtnM.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
        rdbtnM.setBounds(145, 104, 95, 23);
        contentPane.add(rdbtnM);
		
        rdbtnF = new JRadioButton("Féminin"); // Initialize it in the constructor
        buttonGroup.add(rdbtnF);
        rdbtnF.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
        rdbtnF.setBounds(242, 104, 88, 23);
        contentPane.add(rdbtnF);
		
		JLabel lblNewLabel_2 = new JLabel("---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
		lblNewLabel_2.setBounds(0, 123, 992, 14);
		contentPane.add(lblNewLabel_2);
		
		JLabel lblNewLabel_1_2 = new JLabel("Date de naissance (jj/mm/aaaa) :");
		lblNewLabel_1_2.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_2.setBounds(10, 152, 270, 14);
		contentPane.add(lblNewLabel_1_2);
		
		txt_jours = new JTextField();
		txt_jours.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_jours.setBounds(290, 148, 25, 20);
		contentPane.add(txt_jours);
		txt_jours.setColumns(10);
		
		JLabel lblNewLabel_3 = new JLabel("/");
		lblNewLabel_3.setFont(new Font("Tahoma", Font.PLAIN, 16));
		lblNewLabel_3.setBounds(332, 151, 18, 14);
		contentPane.add(lblNewLabel_3);
		
		txt_mois = new JTextField();
		txt_mois.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_mois.setColumns(10);
		txt_mois.setBounds(354, 148, 25, 20);
		contentPane.add(txt_mois);
		
		txt_annee = new JTextField();
		txt_annee.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_annee.setColumns(10);
		txt_annee.setBounds(417, 148, 54, 20);
		contentPane.add(txt_annee);
		
		JLabel lblNewLabel_3_1 = new JLabel("/");
		lblNewLabel_3_1.setFont(new Font("Tahoma", Font.PLAIN, 16));
		lblNewLabel_3_1.setBounds(389, 151, 18, 14);
		contentPane.add(lblNewLabel_3_1);
		
		JLabel lblNewLabel_1_1_2 = new JLabel("Pays de naissance :");
		lblNewLabel_1_1_2.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_1_2.setBounds(17, 217, 201, 14);
		contentPane.add(lblNewLabel_1_1_2);
		
		JLabel lblNewLabel_1_1_2_1 = new JLabel("Nationalité :");
		lblNewLabel_1_1_2_1.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_1_2_1.setBounds(445, 217, 162, 14);
		contentPane.add(lblNewLabel_1_1_2_1);
		
        cbx_nationalite = new JComboBox();
        cbx_nationalite.setModel(new DefaultComboBoxModel(new String[] {"Français", "Anglais", "Allemand", "Norvégien", "Portugais", "Espagnol", "Italien", "Américain", "Brésilien", "Autrichien", "Irlandais", "Ukrainien", "Russe"})); // Initialize it in the constructor
        cbx_nationalite.setFont(new Font("Tahoma", Font.PLAIN, 14));
        cbx_nationalite.setBounds(617, 212, 104, 22);
        contentPane.add(cbx_nationalite);
		
		JLabel lblNewLabel_2_1 = new JLabel("-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
		lblNewLabel_2_1.setBounds(0, 259, 1005, 14);
		contentPane.add(lblNewLabel_2_1);
		
		JLabel lblNewLabel_1_1_3 = new JLabel("Adresse :");
		lblNewLabel_1_1_3.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_1_3.setBounds(445, 58, 104, 14);
		contentPane.add(lblNewLabel_1_1_3);
		
		JLabel lblNewLabel_1_1_3_1 = new JLabel("Code postal :");
		lblNewLabel_1_1_3_1.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lblNewLabel_1_1_3_1.setBounds(445, 83, 114, 14);
		contentPane.add(lblNewLabel_1_1_3_1);
		
		JButton btn_confirmer = new JButton("Confirmer");
		btn_confirmer.setBounds(395, 586, 119, 45);
		contentPane.add(btn_confirmer);
		
		txt_adresse = new JTextField();
		txt_adresse.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_adresse.setColumns(10);
		txt_adresse.setBounds(612, 54, 185, 20);
		contentPane.add(txt_adresse);
		
		txt_cp = new JTextField();
		txt_cp.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_cp.setColumns(10);
		txt_cp.setBounds(612, 79, 185, 20);
		contentPane.add(txt_cp);
		
		JLabel lbl_email = new JLabel("email :");
		lbl_email.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lbl_email.setBounds(21, 318, 147, 14);
		contentPane.add(lbl_email);
		
		txt_email = new JTextField();
		txt_email.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_email.setColumns(10);
		txt_email.setBounds(145, 314, 185, 20);
		contentPane.add(txt_email);
		
		JLabel lbl_tuteur = new JLabel("tuteur :");
		lbl_tuteur.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lbl_tuteur.setBounds(17, 387, 163, 14);
		contentPane.add(lbl_tuteur);
		
		txt_tuteur = new JTextField();
		txt_tuteur.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_tuteur.setColumns(10);
		txt_tuteur.setBounds(145, 383, 185, 20);
		contentPane.add(txt_tuteur);
		
		JLabel lblNewLabel_2_1_1 = new JLabel("---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
		lblNewLabel_2_1_1.setBounds(0, 475, 964, 14);
		contentPane.add(lblNewLabel_2_1_1);
		
		txt_numTel = new JTextField();
		txt_numTel.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_numTel.setColumns(10);
		txt_numTel.setBounds(693, 314, 185, 20);
		contentPane.add(txt_numTel);
		
		txt_ville = new JTextField();
		txt_ville.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_ville.setColumns(10);
		txt_ville.setBounds(693, 383, 185, 20);
		contentPane.add(txt_ville);
		
		JLabel lbl_numtel = new JLabel("Numero de telephone :");
		lbl_numtel.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lbl_numtel.setBounds(445, 318, 207, 14);
		contentPane.add(lbl_numtel);
		
		JLabel lbl_ville = new JLabel("ville :");
		lbl_ville.setFont(new Font("OCR A Extended", Font.PLAIN, 14));
		lbl_ville.setBounds(445, 387, 174, 14);
		contentPane.add(lbl_ville);
		
		txt_paysNaiss = new JTextField();
		txt_paysNaiss.setFont(new Font("Tahoma", Font.PLAIN, 14));
		txt_paysNaiss.setColumns(10);
		txt_paysNaiss.setBounds(190, 216, 185, 20);
		contentPane.add(txt_paysNaiss);
		
		btn_confirmer.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				//gere les entrées de l'utilisateur
				 if (!estFormatLettreUniquement(txt_nom.getText())) {
			            afficherMessageErreur("Le nom doit contenir uniquement des lettres.");
			            return;
			        }

			        if (!estFormatLettreUniquement(txt_prenom.getText())) {
			            afficherMessageErreur("Le prénom doit contenir uniquement des lettres.");
			            return;
			        }
			        
			        if (!estFormatAlphaNumeriqueValide(txt_adresse.getText())) {
			        	afficherMessageErreur("L'adresse doit contenir uniquement des chiffres et des lettres");
			        }

			        if (!estFormatDateValide(txt_jours.getText(), txt_mois.getText(), txt_annee.getText())) {
			            afficherMessageErreur("La date de naissance doit être au format jj/mm/aaaa et être une date valide.");
			            return;
			        }

			        if (!estFormatCodePostalValide(txt_cp.getText())) {
			            afficherMessageErreur("Le code postal doit contenir 5 chiffres.");
			            return;
			        }

			        if (!estFormatEmailValide(txt_email.getText())) {
			            afficherMessageErreur("L'adresse e-mail n'est pas valide.");
			            return;
			        }

			        if (!estFormatNumeroTelValide(txt_numTel.getText())) {
			            afficherMessageErreur("Le numéro de téléphone n'est pas valide.");
			            return;
			        }
			        
			        if (!estFormatLettreUniquement(txt_paysNaiss.getText())) {
			            afficherMessageErreur("Le pays doit contenir uniquement des lettres.");
			            return;
			        }
			        
			        if (!estFormatLettreUniquement(txt_tuteur.getText())) {
			            afficherMessageErreur("Le tuteur doit contenir uniquement des lettres.");
			            return;
			        }
			        
			        if (!estFormatLettreUniquement(txt_ville.getText())) {
			            afficherMessageErreur("La ville doit contenir uniquement des lettres.");
			            return;
			        }
			        
				
				if (adherentActuel == null) {
                // Récupérer les données du formulaire
				int id = 0;
				try {
					id = gestionAdherents.loadedAdherentsFromXML().getLastAdherentId() + 1;
				} catch (ParserConfigurationException | SAXException | IOException | ParseException e2) {
					// TODO Auto-generated catch block
					e2.printStackTrace();
				}
                String nom = txt_nom.getText();
                String prenom = txt_prenom.getText();
                String genre = (rdbtnM.isSelected()) ? "Masculin" : "Féminin";

                // Récupérer et formater la date de naissance
                String jours = txt_jours.getText();
                String mois = txt_mois.getText();
                String annee = txt_annee.getText();
                SimpleDateFormat dateFormat = new SimpleDateFormat("dd/MM/yyyy");
                Date dateNaissance = null;
                try {
                    dateNaissance = dateFormat.parse(jours + "/" + mois + "/" + annee);
                } catch (ParseException e1) {
                    e1.printStackTrace();
                }
                
                String paysNaissance = txt_paysNaiss.getText();
                String nationalite = cbx_nationalite.getSelectedItem().toString();
                String adresse = txt_adresse.getText();
                int codePostal = Integer.parseInt(txt_cp.getText());
                String email = txt_email.getText();
                String tuteur = txt_tuteur.getText();
                int numeroTelephone = Integer.parseInt(txt_numTel.getText());
                String ville = txt_ville.getText();   
                
                int anneeInt = Integer.parseInt(annee);
                int categoryId = CategorieRepository.getCategorie(anneeInt);
                

                // Créer un nouvel adhérent
                Adherent newAdherent = new Adherent(id, nom, prenom, dateNaissance, genre, paysNaissance, nationalite, adresse, codePostal, ville, numeroTelephone, email, tuteur, categoryId);

                // Ajouter l'adhérent
                try {
                    gestionAdherents.loadedAdherentsFromXML().ajouterAdherent(newAdherent);
                    gestionAdherents.mettreAJourTableau(gestionAdherents.loadedAdherentsFromXML().getTousLesAdherentsXML().getAdherents());
				} catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}
				}
				else {
					// Update the existing adherent

				    // Récupérer les données du formulaire
				    String nom = txt_nom.getText();
				    String prenom = txt_prenom.getText();
				    String genre = (rdbtnM.isSelected()) ? "Masculin" : "Féminin";

				    // Récupérer et formater la date de naissance
				    String jours = txt_jours.getText();
				    String mois = txt_mois.getText();
				    String annee = txt_annee.getText();
				    SimpleDateFormat dateFormat = new SimpleDateFormat("dd/MM/yyyy");
				    Date dateNaissance = null;
				    try {
				        dateNaissance = dateFormat.parse(jours + "/" + mois + "/" + annee);
				    } catch (ParseException e1) {
				        e1.printStackTrace();
				    }

				    String paysNaissance = txt_paysNaiss.getText(); // Modify this line to get the country from the appropriate field.
				    String nationalite = cbx_nationalite.getSelectedItem().toString();
				    String adresse = txt_adresse.getText();
				    int codePostal = Integer.parseInt(txt_cp.getText());
				    String email = txt_email.getText();
				    String tuteur = txt_tuteur.getText();
				    int numeroTelephone = Integer.parseInt(txt_numTel.getText());
				    String ville = txt_ville.getText();
	                int anneeInt = Integer.parseInt(annee);
	                int categoryId = CategorieRepository.getCategorie(anneeInt);
	                
	                System.out.println(categoryId);

				    // Update the existing adherent with the new data
				    adherentActuel.setNom(nom);
				    adherentActuel.setPrenom(prenom);
				    adherentActuel.setGenre(genre);
				    adherentActuel.setDateAniv(dateNaissance);
				    adherentActuel.setPaysNaiss(paysNaissance);
				    adherentActuel.setNationalite(nationalite);
				    adherentActuel.setAdresse(adresse);
				    adherentActuel.setCP(codePostal);
				    adherentActuel.setMail(email);
				    adherentActuel.setTuteur(tuteur);
				    adherentActuel.setNumTel(numeroTelephone);
				    adherentActuel.setVille(ville);
				    adherentActuel.setCategorie(categoryId);
				    
                    try {
						gestionAdherents.loadedAdherentsFromXML().modifierAdherent(adherentActuel);
	                    gestionAdherents.mettreAJourTableau(gestionAdherents.loadedAdherentsFromXML().getTousLesAdherentsXML().getAdherents());
					} catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
						// TODO Auto-generated catch block
						e1.printStackTrace();
					}
					
				}

                // Fermer la fenêtre
                dispose();
            }
		});	

    }
    
		
	    DefaultListModel<Adherent> listModel = new DefaultListModel<>();
	    private JTextField txt_adresse;
	    private JTextField txt_cp;
	    private JTextField txt_email;
	    private JTextField txt_tuteur;
	    private JTextField txt_numTel;
	    private JTextField txt_ville;
	    private JTextField txt_paysNaiss;
	}

