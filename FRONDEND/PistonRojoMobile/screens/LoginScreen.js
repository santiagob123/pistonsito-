import React, { useState } from 'react';
import { View, Text, TextInput, Button, StyleSheet, Alert } from 'react-native';

const LoginScreen = ({ navigation }) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = async () => {
    try {
      const response = await fetch('http://10.1.193.215/PistonRojo/Controlador/controladorLogin.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'Accept': 'application/json', // Indica que esperas una respuesta JSON
        },
        body: new URLSearchParams({
          userEmail: email,
          userPassword: password,
        }).toString(),
      });

      if (!response.ok) {
        throw new Error('Error en la conexión con el servidor');
      }

      const data = await response.json();

      if (data.success) {
        Alert.alert('Éxito', data.message);

        // Redirigir según el rol
        if (data.role === 1) {
          navigation.navigate('AdminDashboard'); // Redirige al panel de administrador
        } else if (data.role === 2) {
          navigation.navigate('UserDashboard'); // Redirige al panel de usuario
        }
      } else {
        Alert.alert('Error', data.message);
      }
    } catch (error) {
      Alert.alert('Error', 'No se pudo conectar con el servidor');
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Iniciar Sesión</Text>
      <TextInput
        style={styles.input}
        placeholder="Correo electrónico"
        value={email}
        onChangeText={setEmail}
        keyboardType="email-address"
        autoCapitalize="none"
      />
      <TextInput
        style={styles.input}
        placeholder="Contraseña"
        value={password}
        onChangeText={setPassword}
        secureTextEntry
      />
      <Button title="Iniciar Sesión" onPress={handleLogin} />
      <View style={{ marginTop: 20 }}>
        <Button
          title="Registrarse"
          onPress={() => navigation.navigate('RegisterScreen')} // Navega a la pantalla de registro
        />
      </View>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  input: { width: '100%', padding: 10, borderWidth: 1, borderColor: '#ccc', borderRadius: 5, marginBottom: 20 },
});

export default LoginScreen;