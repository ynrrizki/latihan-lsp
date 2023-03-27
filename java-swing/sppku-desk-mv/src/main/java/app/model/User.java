package app.model;

import database.Database;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import org.mindrot.jbcrypt.BCrypt;

public class User {
    private static Statement statement;
    private static Connection conn = Database.getConnection();
    private static ResultSet resultSet;

    public static final String[] TABLE_HEADER = {"ID", "Nama", "Username", "Email"};

    public static String[][] getAll() {
        String query = "SELECT * FROM users WHERE role = 'OPERATOR'";
        int row = 0;
        String[][] result = null;

        try {
            statement = conn.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
            resultSet = statement.executeQuery(query);

            // hitung jumlah baris pada ResultSet
            resultSet.last();
            int rowCount = resultSet.getRow();
            resultSet.beforeFirst();

            // buat array 2 dimensi dengan ukuran rowCount x 3
            result = new String[rowCount][4];

            // baca setiap baris dan simpan ke dalam array
            while (resultSet.next()) {
                result[row][0] = resultSet.getString("id");
                result[row][1] = resultSet.getString("name");
                result[row][2] = resultSet.getString("username");
                result[row][3] = resultSet.getString("email");
                row++;
            }
        } catch (SQLException e) {
            e.printStackTrace();
        } finally {
            try {
                resultSet.close();
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }

        return result;
    }

    public static boolean insert(String name, String email, String username, String password, String role) {
        String hashedPassword = BCrypt.hashpw(password, BCrypt.gensalt());
        String query = "INSERT INTO users(name, email, username, password, role) VALUES ('" + name + "', '" + email + "', '" + username + "' ,'" + hashedPassword + "','" + role + "')";

        try {
            statement = conn.createStatement();
            statement.executeUpdate(query);
            return true;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        } finally {
            try {
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public static boolean update(int id, String name, String email, String password) {
        String query;
        if (password == null || password.isEmpty()) {
            query = "UPDATE users SET name='" + name + "', email='" + email + "' WHERE id=" + id;
        } else {
            String hashedPassword = BCrypt.hashpw(password, BCrypt.gensalt());
            query = "UPDATE users SET name='" + name + "', email='" + email + "', password='" + hashedPassword + "' WHERE id=" + id;
        }
        
        try {
            statement = conn.createStatement();
            statement.executeUpdate(query);
            return true;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        } finally {
            try {
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    public static boolean delete(int id) {
        String query = "DELETE FROM users WHERE id=" + id;
        
        try {
            statement = conn.createStatement();
            statement.executeUpdate(query);
            return true;
        } catch (SQLException e) {
            e.printStackTrace();
            return false;
        } finally {
            try {
                statement.close();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

}
