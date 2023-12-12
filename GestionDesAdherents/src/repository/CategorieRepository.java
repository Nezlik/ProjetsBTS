package repository;

import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.DocumentBuilder;
import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.w3c.dom.Node;
import org.w3c.dom.Element;
import java.io.File;

public class CategorieRepository {
	
	public static int getCategorie(int anneeAdherent) {
	    int categoryId = -1; // Default ID indicating no match found

	    try {
	        File xmlFile = new File("D:/Apadherent/XML/categorie.xml");
	        DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
	        DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
	        Document doc = dBuilder.parse(xmlFile);

	        doc.getDocumentElement().normalize();

	        NodeList categorieList = doc.getElementsByTagName("categorie");

	        for (int i = 0; i < categorieList.getLength(); i++) {
	            Node categorieNode = categorieList.item(i);
	            if (categorieNode.getNodeType() == Node.ELEMENT_NODE) {
	                Element categorieElement = (Element) categorieNode;
	                int id = Integer.parseInt(categorieElement.getAttribute("id"));
	                int anneeMin = Integer.parseInt(categorieElement.getElementsByTagName("annee_min").item(0).getTextContent());
	                int anneeMax = Integer.parseInt(categorieElement.getElementsByTagName("annee_max").item(0).getTextContent());

	                // Check if the given year falls within the range
	                if (anneeAdherent >= anneeMin && anneeAdherent <= anneeMax) {
	                    categoryId = id;
	                    break; // No need to continue checking other categories
	                }
	            }
	        }
	    } catch (Exception e) {
	        e.printStackTrace();
	    }

	    return categoryId;
	}

	
}
