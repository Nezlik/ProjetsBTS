package GestionDesAdherents.graphique;

import java.awt.Dimension;

import java.awt.EventQueue;
import java.io.IOException;
import java.text.ParseException;
import java.util.List;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.border.EmptyBorder;
import javax.swing.table.DefaultTableModel;

import org.xml.sax.SAXException;

import GestionDesAdherents.Adherent;
import repository.AdherentsRepository;

import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTable;
import javax.swing.JTextField;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.RowFilter;
import javax.swing.event.DocumentEvent;
import javax.swing.event.DocumentListener;
import javax.swing.table.TableRowSorter;
import javax.xml.parsers.ParserConfigurationException;

import com.itextpdf.text.Document;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.PdfWriter;

import java.io.File;
import java.io.FileOutputStream;

public class JFGestionDesAdherents extends JFrame {

    /**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private DefaultTableModel tableModel;
    private JTable adherentsTable;
    private JTextField txt_rechercher;
    private JComboBox<String> Cbx_anniv;
    

    public static void main(String[] args) {
        EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    JFGestionDesAdherents frame = new JFGestionDesAdherents();
                    frame.setVisible(true);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }
    
    
    //création du tableau avec les adherent de la liste
    public AdherentsRepository loadedAdherentsFromXML() throws ParserConfigurationException, SAXException, IOException, ParseException {

            AdherentsRepository repository = new AdherentsRepository();
            
            tableModel.setRowCount(0);

            
            for (Adherent adherent : repository.getTousLesAdherentsXML().getAdherents()) {
                tableModel.addRow(new Object[]{adherent.getId(), adherent.getNom(), adherent.getPrenom(), adherent.getGenre(), adherent.getCategorie(), adherent.getFraisAdhesion()});
            }
         
        return repository;
    }
    
    //mise a jour des données du tableau
    public void mettreAJourTableau(List<Adherent> adherents) throws ParserConfigurationException, SAXException, IOException, ParseException {
        tableModel.setRowCount(0); // Clear the table
        loadedAdherentsFromXML();
    }
    
    
    //methode pour filtre le tableau
	private void searchFilter() {
        String query = txt_rechercher.getText();
        if (query.length() == 0) {
            ((TableRowSorter<DefaultTableModel>) adherentsTable.getRowSorter()).setRowFilter(null);
        } else {
            RowFilter<DefaultTableModel, Object> rowFilter = RowFilter.regexFilter(query, Cbx_anniv.getSelectedIndex());
            ((TableRowSorter<DefaultTableModel>) adherentsTable.getRowSorter()).setRowFilter(rowFilter);
        }
    }
	
	private void exportAdherentToPDF(Adherent adherent) throws Exception {
	    String userHome = System.getProperty("user.home"); // Obtient le répertoire utilisateur
	    String downloadsPath = userHome + File.separator + "Downloads"; // Ajoute "Downloads" au chemin
	    
	    File downloadsDir = new File(downloadsPath);
	    if (!downloadsDir.exists()) {
	        downloadsDir.mkdir(); // Crée le répertoire "Downloads" s'il n'existe pas
	    }
	    
	    String pdfFilePath = downloadsPath + File.separator + "Adherent.pdf"; // Chemin complet du fichier PDF

	    Document document = new Document();
	    PdfWriter.getInstance(document, new FileOutputStream(pdfFilePath));
	    document.open();

	    // Ajoutez les données de l'adhérent au document PDF
	    document.add(new Paragraph("ID : " + adherent.getId()));
	    document.add(new Paragraph("Nom : " + adherent.getNom()));
	    document.add(new Paragraph("Prénom : " + adherent.getPrenom()));
	    document.add(new Paragraph("Genre : " + adherent.getGenre()));
	    document.add(new Paragraph("Catégorie : " + adherent.getCategorie()));
	    document.add(new Paragraph("Frais d'adhésion : " + adherent.getFraisAdhesion()));

	    document.close();
	}

    public JFGestionDesAdherents() throws ParserConfigurationException, SAXException, IOException, ParseException {
    	
        setResizable(false);
        setTitle("Gestion des adhérents");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(new Dimension(800, 502));
        JPanel contentPane = new JPanel();
        contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
        setContentPane(contentPane);
        contentPane.setLayout(null);

        String[] columnNames = {"id", "Nom", "Prénom", "Genre", "Catégorie", "frais"};
        tableModel = new DefaultTableModel(columnNames, 0); // 0 initial rows
        adherentsTable = new JTable(tableModel);
        adherentsTable.setDefaultEditor(Object.class, null);

        // Utilisez un TableRowSorter pour la recherche
        TableRowSorter<DefaultTableModel> rowSorter = new TableRowSorter<>(tableModel);
        adherentsTable.setRowSorter(rowSorter);

        JScrollPane scrollPane = new JScrollPane(adherentsTable);
        scrollPane.setBounds(10, 70, 764, 338);
        contentPane.add(scrollPane);

        JButton btn_ajouter = new JButton("Ajouter");
        btn_ajouter.setBounds(20, 419, 99, 33);
        contentPane.add(btn_ajouter);
        
        btn_ajouter.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                JFFormulaireInscription lectureFrame;
                try {
                    lectureFrame = new JFFormulaireInscription(JFGestionDesAdherents.this);
                    lectureFrame.setVisible(true);
                } catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
                    e1.printStackTrace();
                }
            }
        });

        JButton btn_Supprimer = new JButton("Supprimer");
        btn_Supprimer.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                int selectedRow = adherentsTable.getSelectedRow();
                if (selectedRow >= 0) {
                    int adhId = Integer.parseInt(tableModel.getValueAt(selectedRow, 0).toString());
                    System.out.println(adhId);
                    // Supposons que l'ID est dans la première colonne
                    try {
						loadedAdherentsFromXML().supprimerAdherent(adhId);
					} catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
						// TODO Auto-generated catch block
						e1.printStackTrace();
					}
                    
                    try {
						loadedAdherentsFromXML();
					} catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
						// TODO Auto-generated catch block
						e1.printStackTrace();
					}
                    
                    // Actualisez la table ou d'autres composants au besoin
                } else {
                    JOptionPane.showMessageDialog(null, "Veuillez sélectionner un adhérent à supprimer.", "Aucune sélection", JOptionPane.INFORMATION_MESSAGE);
                }
            }
        });
        btn_Supprimer.setBounds(129, 419, 99, 33);
        contentPane.add(btn_Supprimer);

        JButton btn_Modifier = new JButton("Modifier");
        btn_Modifier.addActionListener(new ActionListener() {
        	public void actionPerformed(ActionEvent e) {
        		int selectedRow = adherentsTable.getSelectedRow();

        		if (selectedRow >= 0) {
        		    int adhId = Integer.parseInt(tableModel.getValueAt(selectedRow, 0).toString());
        		    System.out.println(adhId);

        		    List<Adherent> adherents = null;
					try {
						adherents = loadedAdherentsFromXML().getTousLesAdherentsXML().getAdherents();
					} catch (ParserConfigurationException | SAXException | IOException | ParseException e2) {
						// TODO Auto-generated catch block
						e2.printStackTrace();
					}
        		    
        		    // Recherche de l'adhérent par son ID
        		    Adherent adhAModif = null;
        		    for (Adherent adherent : adherents) {
        		        if (adherent.getId() == adhId) {
        		            adhAModif = adherent;
        		            break; // Sort de la boucle dès que l'adhérent est trouvé
        		        }
        		    }

        		    if (adhAModif != null) {
        		        JFFormulaireInscription lectureFrame;
        		        try {
        		            // Ouvrir le formulaire prérempli avec les données de l'adhérent
        		            lectureFrame = new JFFormulaireInscription(JFGestionDesAdherents.this);
        		            lectureFrame.preRemplirFormulaire(adhAModif); // Appel de la méthode pour préremplir le formulaire
        		            lectureFrame.setVisible(true);
        		        } catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
        		            e1.printStackTrace();
        		        }
        		    } else {
        		        System.out.println("Adhérent non trouvé.");
        		    }
        		}
        	}
        });
        btn_Modifier.setBounds(566, 419, 99, 33);
        contentPane.add(btn_Modifier);

        JButton btn_exporter = new JButton("Exporter");
        btn_exporter.addActionListener(new ActionListener() {
        	public void actionPerformed(ActionEvent e) {
        		 int selectedRow = adherentsTable.getSelectedRow();

        	        if (selectedRow >= 0) {
        	            int adhId = Integer.parseInt(tableModel.getValueAt(selectedRow, 0).toString());
        	            
        	            // Supposons que l'ID est dans la première colonne
        	            List<Adherent> adherents;
        	            
        	            try {
        	                adherents = loadedAdherentsFromXML().getTousLesAdherentsXML().getAdherents();
        	                // Recherche de l'adhérent par son ID
        	                Adherent adhSelect = null;
        	                for (Adherent adherent : adherents) {
        	                    if (adherent.getId() == adhId) {
        	                        adhSelect = adherent;
        	                        break;
        	                    }
        	                }
        	                
        	                if (adhSelect != null) {
        	                    try {
        	                        exportAdherentToPDF(adhSelect);
        	                        JOptionPane.showMessageDialog(null, "Adhérent exporté en PDF.", "Export réussi", JOptionPane.INFORMATION_MESSAGE);
        	                    } catch (Exception ex) {
        	                        ex.printStackTrace();
        	                        JOptionPane.showMessageDialog(null, "Erreur lors de l'exportation en PDF.", "Erreur", JOptionPane.ERROR_MESSAGE);
        	                    }
        	                } else {
        	                    System.out.println("Adhérent non trouvé.");
        	                }
        	            } catch (ParserConfigurationException | SAXException | IOException | ParseException e1) {
        	                e1.printStackTrace();
        	            }
        	        } else {
        	            JOptionPane.showMessageDialog(null, "Veuillez sélectionner un adhérent à exporter.", "Aucune sélection", JOptionPane.INFORMATION_MESSAGE);
        	        }
        	    }
        	
        });
        btn_exporter.setBounds(675, 419, 99, 33);
        contentPane.add(btn_exporter);

        txt_rechercher = new JTextField();
        txt_rechercher.setBounds(196, 40, 177, 20);
        contentPane.add(txt_rechercher);
        txt_rechercher.setColumns(10);

        Cbx_anniv = new JComboBox<>(columnNames);
        Cbx_anniv.setBounds(10, 37, 152, 22);
        contentPane.add(Cbx_anniv);

        JLabel lbl_titre = new JLabel("Gestion des adhérents");
        lbl_titre.setFont(new Font("OCR A Extended", Font.BOLD, 18));
        lbl_titre.setBounds(10, 11, 299, 14);
        contentPane.add(lbl_titre);
        
        loadedAdherentsFromXML();
        

        // Ajoutez un écouteur de document pour le champ de recherche
        txt_rechercher.getDocument().addDocumentListener(new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                searchFilter();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                searchFilter();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {
                searchFilter();
            }
        });
    } 
}
