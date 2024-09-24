//helper untuk mengubah text menjadi slug
const slugify = (text) => {
    return text.trim()
        .toLowerCase()
        .replace(/\s+/g, '-')//spasi = -
        .replace(/[^\w\-]+/g, '')//hapus karakter non-alphanumeric
        .replace(/-+/g, '-');//ganti beberapa - dengan 1
}