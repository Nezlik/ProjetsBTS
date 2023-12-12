package repository;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.SAXException;

import GestionDesAdherents.Adherent;
import GestionDesAdherents.Gestion;

import java.io.File;
import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

public class AdherentsRepository {

    Gestion gestionAdherent = new Gestion();

    public Gestion getTousLesAdherentsXML() throws ParserConfigurationException, SAXException, IOException, ParseException {
        try {
            DocumentBuilderFactory factory 	= DocumentBuilderFactory.newInstance();
            DocumentBuilder builder = factory.newDocumentBuilder();
            Document sourceDocument = builder.parse("file:///D:/Apadherent/XML/adherents.xml");

            NodeList nodeList = sourceDocument.getElementsByTagName("adherent");

            for (int i = 0; i < nodeList.getLength(); i++) {
                Element adherentElement = (Element) nodeList.item(i);

                int id = parseInt(getElementText(adherentElement, "id"));
                String prenom = getElementText(adherentElement, "prenom");
                String nom = getElementText(adherentElement, "nom");

                String dateAnivText = getElementText(adherentElement, "dateAniv");
                Date dateAniv = null;
                if (!dateAnivText.isEmpty()) {
                    SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                    dateAniv = dateFormat.parse(dateAnivText);
                }

                String genre = getElementText(adherentElement, "genre");
                String paysNaiss = getElementText(adherentElement, "paysNaiss");
                String nationalite = getElementText(adherentElement, "nationalite");
                String adresse = getElementText(adherentElement, "adresse");
                int CP = parseInt(getElementText(adherentElement, "CP"));
                String ville = getElementText(adherentElement, "ville");
                int numTel = parseInt(getElementText(adherentElement, "numTel"));
                String mail = getElementText(adherentElement, "mail");
                String tuteur = getElementText(adherentElement, "tuteur");
                int categorie = parseInt(getElementText(adherentElement, "categorie"));

                Adherent adherent = new Adherent(id, prenom, nom, dateAniv, genre, paysNaiss, nationalite, adresse, CP, ville, numTel, mail, tuteur, categorie);
                gestionAdherent.addAdherent(adherent);
            }
        } catch (Exception e) {
            e.printStackTrace();
        }

        return gestionAdherent;
    }

    public Gestion newAdherent(int id, String prenom, String nom, Date dateAniv, String genre, String paysNaiss,
            String nationalite, String adresse, int CP, String ville, int numTel, String mail,
            String tuteur, int categorie) {

        Adherent newAdherent = new Adherent(id, prenom, nom, dateAniv, genre, paysNaiss, nationalite, adresse, CP, ville, numTel, mail, tuteur, categorie);
        gestionAdherent.addAdherent(newAdherent);

        return gestionAdherent;
    }

    // Méthode pour obtenir le texte d'un élément, en vérifiant s'il est null
    private String getElementText(Element parentElement, String tagName) {
        Element element = (Element) parentElement.getElementsByTagName(tagName).item(0);
        if (element != null) {
            return element.getTextContent();
        } else {
            return "";
        }
    }

    // Méthode pour convertir une chaîne en entier en vérifiant si elle est vide
    private int parseInt(String text) {
        if (!text.isEmpty()) {
            return Integer.parseInt(text);
        } else {
            return 0; // Valeur par défaut en cas de chaîne vide
        }
    }
    
    public int getLastAdherentId() {
        int lastId = 0; // Initialisez à 0 comme valeur par défaut si aucun adhérent n'est trouvé.
        try {
            DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder docBuilder = docFactory.newDocumentBuilder();
            Document doc = docBuilder.parse("file:///D:/Apadherent/XML/adherents.xml");

            NodeList adherentNodes = doc.getElementsByTagName("adherent");
            for (int i = 0; i < adherentNodes.getLength(); i++) {
                Element adherentElement = (Element) adherentNodes.item(i);
                int id = Integer.parseInt(getElementText(adherentElement, "id"));
                if (id > lastId) {
                    lastId = id;
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
        return lastId;
    }
    
    public void ajouterAdherent(Adherent adherent) {
        try {
            DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder docBuilder = docFactory.newDocumentBuilder();
            Document doc = docBuilder.parse("file:///D:/Apadherent/XML/adherents.xml");

            // Crée un nouvel élément "adherent"
            Element nouvelAdherent = doc.createElement("adherent");

            // Crée et ajoute des éléments pour les attributs de l'adhérent
            
            Element idElement = doc.createElement("id");
            idElement.appendChild(doc.createTextNode(Integer.toString(adherent.getId()))); // Convertissez l'ID en chaîne
            nouvelAdherent.appendChild(idElement);
            
            Element prenomElement = doc.createElement("prenom");
            prenomElement.appendChild(doc.createTextNode(adherent.getPrenom()));
            nouvelAdherent.appendChild(prenomElement);

            Element nomElement = doc.createElement("nom");
            nomElement.appendChild(doc.createTextNode(adherent.getNom()));
            nouvelAdherent.appendChild(nomElement);

            Element dateAnivElement = doc.createElement("dateAniv");
            SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
            dateAnivElement.appendChild(doc.createTextNode(dateFormat.format(adherent.getDateAniv())));
            nouvelAdherent.appendChild(dateAnivElement);

            Element genreElement = doc.createElement("genre");
            genreElement.appendChild(doc.createTextNode(adherent.getGenre()));
            nouvelAdherent.appendChild(genreElement);

            Element paysNaissElement = doc.createElement("paysNaiss");
            paysNaissElement.appendChild(doc.createTextNode(adherent.getPaysNaiss()));
            nouvelAdherent.appendChild(paysNaissElement);

            Element nationaliteElement = doc.createElement("nationalite");
            nationaliteElement.appendChild(doc.createTextNode(adherent.getNationalite()));
            nouvelAdherent.appendChild(nationaliteElement);

            Element adresseElement = doc.createElement("adresse");
            adresseElement.appendChild(doc.createTextNode(adherent.getAdresse()));
            nouvelAdherent.appendChild(adresseElement);

            Element CPElement = doc.createElement("CP");
            CPElement.appendChild(doc.createTextNode(Integer.toString(adherent.getCP())));
            nouvelAdherent.appendChild(CPElement);

            Element villeElement = doc.createElement("ville");
            villeElement.appendChild(doc.createTextNode(adherent.getVille()));
            nouvelAdherent.appendChild(villeElement);

            Element numTelElement = doc.createElement("numTel");
            numTelElement.appendChild(doc.createTextNode(Integer.toString(adherent.getNumTel())));
            nouvelAdherent.appendChild(numTelElement);

            Element mailElement = doc.createElement("mail");
            mailElement.appendChild(doc.createTextNode(adherent.getMail()));
            nouvelAdherent.appendChild(mailElement);

            Element tuteurElement = doc.createElement("tuteur");
            tuteurElement.appendChild(doc.createTextNode(adherent.getTuteur()));
            nouvelAdherent.appendChild(tuteurElement);

            Element categorieElement = doc.createElement("categorie");
            categorieElement.appendChild(doc.createTextNode(Integer.toString(adherent.getCategorie())));
            nouvelAdherent.appendChild(categorieElement);

            // Ajoute le nouvel adhérent au document
            Element racine = doc.getDocumentElement();
            racine.appendChild(nouvelAdherent);

            // Enregistre les modifications dans le fichier XML
            TransformerFactory transformerFactory = TransformerFactory.newInstance();
            Transformer transformer = transformerFactory.newTransformer();
            DOMSource source = new DOMSource(doc);
            StreamResult result = new StreamResult(new File("D:/Apadherent/XML/adherents.xml"));
            transformer.transform(source, result);

            System.out.println("Nouvel adhérent ajouté avec succès.");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    
    public void supprimerAdherent(int adherentId) {
        try {
            DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder docBuilder = docFactory.newDocumentBuilder();
            Document doc = docBuilder.parse("file:///D:/Apadherent/XML/adherents.xml");

            NodeList adherentNodes = doc.getElementsByTagName("adherent");
            for (int i = 0; i < adherentNodes.getLength(); i++) {
                Element adherentElement = (Element) adherentNodes.item(i);
                int id = Integer.parseInt(getElementText(adherentElement, "id"));
                if (id == adherentId) {
                    // Supprime l'élément de la liste des adhérents
                    doc.getDocumentElement().removeChild(adherentElement);
                    
                    // Enregistre les modifications dans le fichier XML
                    TransformerFactory transformerFactory = TransformerFactory.newInstance();
                    Transformer transformer = transformerFactory.newTransformer();
                    DOMSource source = new DOMSource(doc);
                    StreamResult result = new StreamResult(new File("D:/Apadherent/XML/adherents.xml"));
                    transformer.transform(source, result);
                    
                    System.out.println("Adhérent supprimé avec succès.");
                    return;
                }
            }
            System.out.println("Adhérent non trouvé.");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    
    public void modifierAdherent(Adherent adherent) {
        try {
            DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder docBuilder = docFactory.newDocumentBuilder();
            Document doc = docBuilder.parse("file:///D:/Apadherent/XML/adherents.xml");

            NodeList adherentNodes = doc.getElementsByTagName("adherent");
            for (int i = 0; i < adherentNodes.getLength(); i++) {
                Element adherentElement = (Element) adherentNodes.item(i);
                int id = Integer.parseInt(getElementText(adherentElement, "id"));
                if (id == adherent.getId()) {
                    // Modify the elements for the adherent with the updated data
                    adherentElement.getElementsByTagName("prenom").item(0).setTextContent(adherent.getPrenom());
                    adherentElement.getElementsByTagName("nom").item(0).setTextContent(adherent.getNom());
                    SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                    adherentElement.getElementsByTagName("dateAniv").item(0).setTextContent(dateFormat.format(adherent.getDateAniv()));
                    adherentElement.getElementsByTagName("genre").item(0).setTextContent(adherent.getGenre());
                    adherentElement.getElementsByTagName("paysNaiss").item(0).setTextContent(adherent.getPaysNaiss());
                    adherentElement.getElementsByTagName("nationalite").item(0).setTextContent(adherent.getNationalite());
                    adherentElement.getElementsByTagName("adresse").item(0).setTextContent(adherent.getAdresse());
                    adherentElement.getElementsByTagName("CP").item(0).setTextContent(Integer.toString(adherent.getCP()));
                    adherentElement.getElementsByTagName("ville").item(0).setTextContent(adherent.getVille());
                    adherentElement.getElementsByTagName("numTel").item(0).setTextContent(Integer.toString(adherent.getNumTel()));
                    adherentElement.getElementsByTagName("mail").item(0).setTextContent(adherent.getMail());
                    adherentElement.getElementsByTagName("tuteur").item(0).setTextContent(adherent.getTuteur());
                    adherentElement.getElementsByTagName("categorie").item(0).setTextContent(Integer.toString(adherent.getCategorie()));

                    // Save the modified document back to the XML file
                    TransformerFactory transformerFactory = TransformerFactory.newInstance();
                    Transformer transformer = transformerFactory.newTransformer();
                    DOMSource source = new DOMSource(doc);
                    StreamResult result = new StreamResult(new File("D:/Apadherent/XML/adherents.xml"));
                    transformer.transform(source, result);

                    System.out.println("Adhérent modifié avec succès.");
                    return;
                }
            }
            System.out.println("Adhérent non trouvé.");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public static void main(String[] args) throws ParserConfigurationException, SAXException, IOException, ParseException {
        AdherentsRepository repository = new AdherentsRepository();
        repository.getTousLesAdherentsXML();
        for (Adherent item : repository.gestionAdherent.getAdherents()) {
            System.out.println(item);
        }
    }
}
