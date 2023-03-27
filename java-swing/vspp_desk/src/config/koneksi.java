package config;

import java.sql.*;
import javax.swing.JOptionPane;

public class koneksi {

    Connection con;
    
    public static Connection connect() {
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost/vspp", "root", "");
            System.out.println("succses connecting");
            
            return con;
        } catch(Exception e) {
            JOptionPane.showMessageDialog(null, e);
            return null;
        }
    }
    
}
