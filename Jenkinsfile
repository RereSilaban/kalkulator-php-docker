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
             mail to: 'reisnaulilammaida@gmail.com',
             subject: "Yuhu! Build ${env.JOB_NAME} Updated nih!",
             body: "Ada Update dan buld baru ya. Link: ${env.BUILD_URL}"
        }
        failure {
            echo 'Build Gagal! Mengirim email...'
            mail to: 'reisnaulilammaida@gmail.com',
            subject: "Waduh! Build ${env.JOB_NAME} Gagal nih!",
            body: "Cek buruan di Jenkins ya, ada yang error pas build Docker-nya. Link: ${env.BUILD_URL}"
            // Di sini nanti email notifikasi akan otomatis terpicu
        }
    }
}