pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo 'Mengambil kode dari folder...'
                // Karena file ada di D:, Jenkins akan otomatis baca folder tempat workspace-nya
            }
        }
        stage('Build Docker Image') {
            steps {
                bat 'docker build -t kalkulator-php-test .'
            }
        }
        stage('Deploy Container') {
            steps {
        // Gunakan nama container 'kalkulator-running' (bebas)
        // Tapi nama IMAGE di paling belakang harus 'kalkulator-php-test'
        bat 'docker stop kalkulator-running || exit 0'
        bat 'docker rm kalkulator-running || exit 0'
        bat 'docker run -d --name kalkulator-running -p 9090:80 kalkulator-php-test'
                }
        } 
    }
    post {
        always {
            echo 'Proses Selesai!'
        }
        failure {
            echo 'Build Gagal! Mengirim email...'
            // Di sini nanti email notifikasi akan otomatis terpicu
        }
    }
}