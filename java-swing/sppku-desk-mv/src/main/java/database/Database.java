package database;

import java.sql.Connection;
import java.sql.DriverManager;
import javax.swing.JOptionPane;

public class Database {
    static Connection connection = null;
    
    public static Connection getConnection() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            connection = DriverManager.getConnection("jdbc:mysql://localhost/sppku", "root", "");
            return connection;
        } catch(Exception e) {
            JOptionPane.showMessageDialog(null, e);
            return null;
        }
    } 
}
