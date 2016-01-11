package jakopec;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class ZSI2016 {

	public ZSI2016() {
		try {
			//uz preduvjet da je u build path JDBC driver (https://dev.mysql.com/downloads/connector/j/)
			Class.forName("org.gjt.mm.mysql.Driver");
			Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/omszsi2016", "root", "000000");
			Statement st = conn.createStatement();
			ResultSet rs = st.executeQuery("select a.sifra, a.tekst, count(b.operater) as ukupno "
					+ " from status a inner join svidamisestatus b on a.sifra=b.status " + " group by a.sifra, a.tekst "
					+ " order by 3 desc limit 20 ");
			while (rs.next()) {
				System.out.println(
						"{\"status\":\"" + rs.getString("tekst") + "\",\"svidanja\":" + rs.getInt("ukupno") + "},");
			}
			st.close();
		} catch (Exception e) {
			System.err.println("Got an exception: " + e.getMessage());
		}

	}

	public static void main(String[] args) {
		new ZSI2016();
	}

}
