//id	
//user_id	
//std_class_id	
//nisn	
//nis	
//address	
//phone
package app.model;

import database.Database;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import org.mindrot.jbcrypt.BCrypt;

public class Siswa {

    private int id;
    private int user_id;
    private int std_class_id;
    private String nisn;
    private String nis;
    private String address;
    private String phone;

    private static Statement statement;
    private static Connection conn = Database.getConnection();
    private static ResultSet resultSet;

    public static final String[] TABLE_HEADER = {"ID", "Nama", "Username", "Email", "NISN", "NIS", "Kelas", "Alamat", "No Hp"};

    public static String[][] getAll() {
        String query = "SELECT siswa.id, users.name, users.email, siswa.nisn, siswa.nis, siswa.std_class_id, siswa.address, siswa.phone FROM siswa INNER JOIN users ON siswa.user_id = users.id WHERE users.role = 'STUDENT'";
        int row = 0;
        String[][] result = null;

        try {
            statement = conn.createStatement(ResultSet.TYPE_SCROLL_INSENSITIVE, ResultSet.CONCUR_READ_ONLY);
            resultSet = statement.executeQuery(query);

            // hitung jumlah baris pada ResultSet
            resultSet.last();
            int rowCount = resultSet.getRow();
            resultSet.beforeFirst();

            // buat array 2 dimensi dengan ukuran rowCount x 8
            result = new String[rowCount][8];

            // baca setiap baris dan simpan ke dalam array
            while (resultSet.next()) {
                result[row][0] = resultSet.getString("id");
                result[row][1] = resultSet.getString("name");
                result[row][2] = resultSet.getString("email");
                result[row][3] = resultSet.getString("nisn");
                result[row][4] = resultSet.getString("nis");
                result[row][5] = resultSet.getString("std_class_id");
                result[row][6] = resultSet.getString("address");
                result[row][7] = resultSet.getString("phone");
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
        String query = "INSERT INTO students(name, email, username, password, role) VALUES ('" + name + "', '" + email + "', '" + username + "' ,'" + hashedPassword + "','" + role + "')";

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
            query = "UPDATE students SET name='" + name + "', email='" + email + "' WHERE id=" + id;
        } else {
            String hashedPassword = BCrypt.hashpw(password, BCrypt.gensalt());
            query = "UPDATE students SET name='" + name + "', email='" + email + "', password='" + hashedPassword + "' WHERE id=" + id;
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
        String query = "DELETE FROM students WHERE id=" + id;

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
