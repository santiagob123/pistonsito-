import React from 'react';
import { View, Text, Button, StyleSheet } from 'react-native';

const AdminDashboard = ({ navigation }) => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Panel de Administrador</Text>
      <Button
        title="Gestionar Citas"
        onPress={() => navigation.navigate('ManageCitasScreen')} // Redirige a la pantalla de gestión de citas
      />
      <Button
        title="Cerrar Sesión"
        onPress={() => navigation.navigate('LoginScreen')} // Redirige a la pantalla de login
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
});

export default AdminDashboard;