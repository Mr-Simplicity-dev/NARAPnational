export function buildCRUDRoutes({router, Model, resource}){
  // Create
  router.post('/', async (req, res) => {
    try{
      const doc = await Model.create(req.body);
      res.json(doc);
    }catch(e){ res.status(400).json({message:e.message}); }
  });
  // List
 router.get('/', async (req, res) => {
  try{
    const { page=1, limit=50, sort='-createdAt' } = req.query;
    const docs = await Model.find({}).sort(sort).skip((page-1)*limit).limit(Number(limit));
    const count = await Model.countDocuments({});
    res.json(docs); // Return simple array instead of {data: docs, count}
  }catch(e){ res.status(400).json({message:e.message}); }
});
  // Detail by id
  router.get('/:id', async (req, res) => {
    try{
      const doc = await Model.findById(req.params.id);
      if (!doc) return res.status(404).json({message:'Not found'});
      res.json(doc);
    }catch(e){ res.status(400).json({message:e.message}); }
  });
  // Update
  router.put('/:id', async (req, res) => {
    try{
      const doc = await Model.findByIdAndUpdate(req.params.id, req.body, {new:true});
      if (!doc) return res.status(404).json({message:'Not found'});
      res.json(doc);
    }catch(e){ res.status(400).json({message:e.message}); }
  });
  // Delete
  router.delete('/:id', async (req, res) => {
    try{
      await Model.findByIdAndDelete(req.params.id);
      res.json({ ok: true });
    }catch(e){ res.status(400).json({message:e.message}); }
  });
}
