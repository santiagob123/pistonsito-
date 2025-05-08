import React from 'react';
import { View, Text, Button, StyleSheet } from 'react-native';

const UserDashboard = ({ navigation }) => {
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Bienvenido Usuario</Text>
      <Button
        title="Ver Servicios"
        onPress={() => navigation.navigate('Services')}
      />
      <Button
        title="Cerrar Sesión"
        onPress={() => navigation.navigate('LoginScreen')}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
});

export default UserDashboard;