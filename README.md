# TEMA - Tema Extraído de Maneira Automática

Projeto realizado durante a Maratona Hackathon da Câmara Federal entre os dias 28/10/2013 a 01/11/2013, visando o desenvolvimento de projetos que auxiliem a população brasileria com por meio dos dados abertos do governo.

## Autores
+ Cleriston Dantas > @cleristondantas cleriston@devupsolucoes.com
+ Fernando Nóbrega > @fernandoasevedo fernando@devupsolucoes.com
+ Thiago Faleiros  > thiagodepaulo@gmail.com

## 1- O que é TEMA?

<b>TEMA (Tema Extraído de Maneira Automática)</b> é um aplicativo web que apresenta todos os discursos proferidos pelos Deputados da Camara de forma sucinta e organizada. Os discursos são apresentados por temas, sendo possível encontrar um tema específico, discriminar quais os temas discursado para cada Deputado, quais Deputados mais relacionados a cada tema, como esses temas são espalhados ao longo do tempo e quais as notícias relacionadas.

Os temas extraídos dos discursos são representados por conjunto de palavras com um valor semântico. Cada conjunto de palavras descreve um tema (contexto ou tópico) no qual um conjunto de discurso está abordando. Intuitivamente, considerando que um discurso é sobre um determinado tema, é esperado que palavras específicas possam aparecer com certa frequência:  “rua”, “povo”, “movimento”, “população”, “sociedade”, “manifestações”, “publica”, “politica”, “pais”, “brasileiro” – são palavras frequente em discursos sobre as manifestações populares que ocorreram em Julho de 2013, e juntas, essas palavras formam esse tema.

Os discursos são documentos textuais fornecidos pela Câmara dos Deputados dentro do projeto Dados Abertos. No total, foram coletados mais de cinquenta mil discursos. E desses discursos, foram identificados 200 temas distintos. O processo de descoberta de temas é um trabalho bastante custoso, sendo inviável sua realização por especialistas humanos devido a enorme quantidade de discursos. Dessa forma, é bastante útil a utilização de técnicas computacionais que realizam todo esse processo de forma automática.

O que existe de atual na literatura científica para a identificação automática de temas são os modelos probabilísticos. Esses modelos possuem forte embasamento matemático, em que, pela análise estatísticas das palavras, é possível descobrir qual tema descreve o conjunto de dados textuais. Específico ao sistema TEMA, foi utilizado o modelo LDA (Latent Dirichlet Allocation). O LDA foi criado por pesquisadores da Universidade de Stanford (David Blei, Andrew Ng e Michael Jordan) e possuem diversos trabalhos demonstrando sua eficáfia na identificação automática de temas. 

Foi utilizado o Software Abert MALLET (MAchine Learning for LanguagE Toolkit – http://mallet.cs.umass.edu/) para a execução do algoritmo de inferência do modelo LDA. A ferramenta MALLET utiliza uma versão do algoritmo de amostragem de Gibbs para a inferência do modelo LDA. 

## 2- Descrição do Processamento e Descoberta de Temas.

O processo de extração dos temas foi realizado da seguinte forma:
Coleta dos discursos (Oferecidos pela Câmara dos Deputados por meio da política de Dados Abertos – http://www2.camara.leg.br/transparencia/dados-abertos)
Pré-processamento dos documentos textuais: 

+ Limpeza de dados, remoção de caracteres especiais.
+ Remoção de stop-words.
+ Stemming (Radicalização das palavras)
+ Execução do algoritmo de inferência do modelo LDA com a base de discursos coletados (utilizando o toolkit MALLET)
+ Transcrição das saídas do algoritmo de inferência para a base de dados.


## Acesse em
http://www.devupsolucoes.com/hackathon/
