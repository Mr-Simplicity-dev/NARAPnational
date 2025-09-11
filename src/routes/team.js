import express from 'express';
import TeamMember from '../models/TeamMember.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: TeamMember, resource: 'team' });

export default router;
