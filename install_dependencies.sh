#!/bin/bash

# Script para descargar e instalar la dependencia TCPDF

echo "Iniciando la instalación de dependencias..."

# URL del archivo zip de la biblioteca TCPDF desde GitHub
TCPDF_URL="https://github.com/tecnickcom/TCPDF/archive/refs/heads/main.zip"
ZIP_FILE="tcpdf.zip"

# Descargar la biblioteca
echo "Descargando TCPDF..."
curl -L "$TCPDF_URL" -o "$ZIP_FILE"

# Verificar si la descarga fue exitosa
if [ ! -f "$ZIP_FILE" ]; then
    echo "Error: La descarga de TCPDF falló." >&2
    exit 1
fi

# Extraer el contenido del zip
echo "Extrayendo archivos..."
unzip -q "$ZIP_FILE"

# El contenido se extrae en una carpeta como TCPDF-main, la renombramos a tcpdf
EXTRACTED_FOLDER="TCPDF-main"
if [ ! -d "$EXTRACTED_FOLDER" ]; then
    echo "Error: La extracción falló. No se encontró la carpeta esperada." >&2
    rm "$ZIP_FILE"
    exit 1
fi

# Renombrar la carpeta al nombre esperado por el script PHP
mv "$EXTRACTED_FOLDER" tcpdf

# Limpiar el archivo zip descargado
rm "$ZIP_FILE"

echo "¡Instalación completada! La biblioteca TCPDF está lista en la carpeta 'tcpdf/'."
